<?php

namespace Modules\BpjsAntreanRs\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAntreanRs\Models\Antrean;

/**
 * "Tambah Antrean Farmasi" — pharmacy-queue variant of Tambah Antrean, for
 * hospitals with pharmacy-queue integration. URI/payload shape inferred by
 * analogy with the confirmed antrean/add spec, not individually confirmed.
 * No dedicated table: attaches to the existing Antrean by kodebooking and
 * records the outcome on it (mirrors the jenisresep field used in
 * "Update Waktu Antrean" for the same integration).
 */
class AntreanFarmasiController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function store(Request $request, Antrean $antrean)
    {
        $data = $request->validate([
            'jenisresep' => ['required', 'string', 'max:50'],
            'nomorantrean' => ['required', 'string', 'max:20'],
            'angkaantrean' => ['required', 'integer'],
            'estimasidilayani' => ['required', 'date'],
        ]);

        $payload = [
            'kodebooking' => $antrean->kodebooking,
            'jenisresep' => $data['jenisresep'],
            'nomorantrean' => $data['nomorantrean'],
            'angkaantrean' => $data['angkaantrean'],
            'estimasidilayani' => Carbon::parse($data['estimasidilayani'])->timestamp * 1000,
        ];

        $response = $this->client->call('antrean_rs', 'POST', 'antrean/farmasi/add', $payload);
        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        $antrean->update([
            'bpjs_sync_status' => $success ? 'synced' : 'failed',
            'bpjs_error' => $success ? null : ($response->metadata->message ?? $response->metaData->message ?? null),
        ]);

        return response()->json(['success' => $success, 'antrean' => $antrean->fresh()], $success ? 201 : 422);
    }
}
