<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAntreanRs\Http\Requests\AmbilAntreanRequest;
use Modules\BpjsAntreanRs\Models\Antrean;

/**
 * Inbound WS RS routes called by Mobile JKN (confirmed for "Ambil Antrean";
 * status/sisa/batal/checkin field shapes are best-effort guesses mirroring
 * the confirmed shape, flagged for review).
 */
class MobileJknAntreanController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    /**
     * Ambil Antrean (confirmed spec): create the local booking, generate
     * kodebooking, then register it with BPJS's own antrean/add so both
     * sides agree on the booking, then return the confirmation.
     */
    public function store(AmbilAntreanRequest $request)
    {
        $data = $request->validated();
        $data['kodebooking'] = now()->format('dmYHis').Str::upper(Str::random(4));
        $data['jenispasien'] = $data['nomorkartu'] ?? null ? 'JKN' : 'NON JKN';
        $data['pasienbaru'] = empty($data['norm']);
        $data['status'] = 'draft';

        $antrean = Antrean::create($data);

        $payload = [
            'kodebooking' => $antrean->kodebooking,
            'jenispasien' => $antrean->jenispasien,
            'nomorkartu' => $antrean->nomorkartu,
            'nik' => $antrean->nik,
            'nohp' => $antrean->nohp,
            'kodepoli' => $antrean->kodepoli,
            'namapoli' => $antrean->namapoli,
            'pasienbaru' => $antrean->pasienbaru ? 1 : 0,
            'norm' => $antrean->norm,
            'tanggalperiksa' => $antrean->tanggalperiksa->toDateString(),
            'kodedokter' => $antrean->kodedokter,
            'namadokter' => $antrean->namadokter,
            'jampraktek' => $antrean->jampraktek,
            'jeniskunjungan' => $antrean->jeniskunjungan,
            'nomorreferensi' => $antrean->nomorreferensi,
            'nomorantrean' => '-',
            'angkaantrean' => 0,
            'estimasidilayani' => now()->timestamp * 1000,
            'keterangan' => $antrean->keterangan,
        ];

        $response = $this->client->call('antrean_rs', 'POST', 'antrean/add', $payload);
        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        $antrean->update([
            'request_payload' => $payload,
            'status' => $success ? 'success' : 'failed',
            'bpjs_sync_status' => $success ? 'synced' : 'failed',
            'bpjs_error' => $success ? null : ($response->metadata->message ?? $response->metaData->message ?? null),
        ]);

        return response()->json([
            'response' => [
                'kodebooking' => $antrean->kodebooking,
                'nomorantrean' => $antrean->nomorantrean,
                'angkaantrean' => $antrean->angkaantrean,
                'kodepoli' => $antrean->kodepoli,
                'tanggalperiksa' => $antrean->tanggalperiksa->toDateString(),
            ],
            'metadata' => ['message' => 'Ok', 'code' => 200],
        ], 201);
    }

    /**
     * Status/Sisa Antrean — best-effort guess: local lookup by kodebooking.
     */
    public function show(string $kodebooking)
    {
        $antrean = Antrean::where('kodebooking', $kodebooking)->first();

        if (! $antrean) {
            return response()->json(['metadata' => ['message' => 'Booking tidak ditemukan', 'code' => 404]], 404);
        }

        return response()->json([
            'response' => [
                'kodebooking' => $antrean->kodebooking,
                'status' => $antrean->status,
                'nomorantrean' => $antrean->nomorantrean,
                'angkaantrean' => $antrean->angkaantrean,
            ],
            'metadata' => ['message' => 'Ok', 'code' => 200],
        ]);
    }

    /**
     * Batal Antrean (inbound) — best-effort guess: mirrors the confirmed
     * outbound antrean/batal spec, then updates the local status.
     */
    public function batal(Request $request, string $kodebooking)
    {
        $antrean = Antrean::where('kodebooking', $kodebooking)->firstOrFail();

        $response = $this->client->call('antrean_rs', 'POST', 'antrean/batal', [
            'kodebooking' => $antrean->kodebooking,
            'keterangan' => $request->string('keterangan', 'Dibatalkan oleh peserta melalui Mobile JKN')->toString(),
        ]);

        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        $antrean->update([
            'status' => $success ? 'batal' : $antrean->status,
            'bpjs_sync_status' => $success ? 'synced' : 'failed',
            'bpjs_error' => $success ? null : ($response->metadata->message ?? $response->metaData->message ?? null),
        ]);

        return response()->json(['metadata' => ['message' => $success ? 'Ok' : 'Gagal membatalkan', 'code' => $success ? 200 : 500]], $success ? 200 : 500);
    }

    /**
     * Check In — best-effort guess: marks patient arrival locally.
     */
    public function checkIn(string $kodebooking)
    {
        $antrean = Antrean::where('kodebooking', $kodebooking)->firstOrFail();
        $antrean->update(['status' => 'checked_in']);

        return response()->json(['metadata' => ['message' => 'Ok', 'code' => 200]]);
    }
}
