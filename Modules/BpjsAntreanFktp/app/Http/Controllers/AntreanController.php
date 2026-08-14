<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAntreanFktp\Http\Requests\StoreAntreanRequest;
use Modules\BpjsAntreanFktp\Http\Resources\AntreanResource;
use Modules\BpjsAntreanFktp\Models\Antrean;

/**
 * Internal-facing (auth:sanctum) trigger: register a local visit as a BPJS
 * queue booking. Confirmed against BPJS's "Tambah Antrean" (antrean/add) and
 * "Batal Antrean" (antrean/batal) specs.
 */
class AntreanController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Request $request)
    {
        $query = Antrean::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AntreanResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntreanRequest $request)
    {
        $data = $request->validated();
        $data['kodebooking'] = $this->generateKodebooking();
        $data['status'] = 'draft';
        $data['created_by'] = $request->user()?->id;

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
            'nomorantrean' => $antrean->nomorantrean,
            'angkaantrean' => $antrean->angkaantrean,
            'estimasidilayani' => $antrean->estimasidilayani->timestamp * 1000,
            'sisakuotajkn' => $antrean->sisakuotajkn,
            'kuotajkn' => $antrean->kuotajkn,
            'sisakuotanonjkn' => $antrean->sisakuotanonjkn,
            'kuotanonjkn' => $antrean->kuotanonjkn,
            'keterangan' => $antrean->keterangan,
        ];

        $response = $this->client->call('antrean_fktp', 'POST', 'antrean/add', $payload);
        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        $antrean->update([
            'request_payload' => $payload,
            'status' => $success ? 'success' : 'failed',
            'bpjs_sync_status' => $success ? 'synced' : 'failed',
            'bpjs_error' => $success ? null : ($response->metadata->message ?? $response->metaData->message ?? null),
        ]);

        return (new AntreanResource($antrean->fresh()))->response()->setStatusCode(201);
    }

    public function show(Antrean $antrean): AntreanResource
    {
        return new AntreanResource($antrean);
    }

    public function batal(Request $request, Antrean $antrean)
    {
        $request->validate(['keterangan' => ['required', 'string']]);

        $response = $this->client->call('antrean_fktp', 'POST', 'antrean/batal', [
            'kodebooking' => $antrean->kodebooking,
            'keterangan' => $request->string('keterangan')->toString(),
        ]);

        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        if (! $success) {
            return response()->json(['message' => $response->metadata->message ?? $response->metaData->message ?? 'Gagal membatalkan antrean di BPJS.'], 422);
        }

        $antrean->update(['status' => 'batal', 'bpjs_sync_status' => 'synced', 'bpjs_error' => null]);

        return new AntreanResource($antrean->fresh());
    }

    private function generateKodebooking(): string
    {
        return now()->format('dmYHis').Str::upper(Str::random(4));
    }
}
