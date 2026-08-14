<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAntreanFktp\Models\Antrean;

/**
 * "Ambil Antrean Farmasi" / "Status Antrean Farmasi" — pharmacy-queue
 * variants of Ambil/Status Antrean, for Mobile JKN. Best-effort guess by
 * analogy with the confirmed Ambil Antrean shape — flagged for review.
 */
class MobileJknAntreanFarmasiController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function store(Request $request, string $kodebooking)
    {
        $antrean = Antrean::where('kodebooking', $kodebooking)->firstOrFail();
        $data = $request->validate(['jenisresep' => ['required', 'string', 'max:50']]);

        $response = $this->client->call('antrean_fktp', 'POST', 'antrean/farmasi/add', [
            'kodebooking' => $antrean->kodebooking,
            'jenisresep' => $data['jenisresep'],
            'nomorantrean' => '-',
            'angkaantrean' => 0,
            'estimasidilayani' => now()->timestamp * 1000,
        ]);

        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        return response()->json(['metadata' => ['message' => $success ? 'Ok' : 'Gagal', 'code' => $success ? 200 : 500]], $success ? 201 : 500);
    }

    public function show(string $kodebooking)
    {
        $antrean = Antrean::where('kodebooking', $kodebooking)->firstOrFail();

        return response()->json([
            'response' => ['kodebooking' => $antrean->kodebooking, 'status' => $antrean->status],
            'metadata' => ['message' => 'Ok', 'code' => 200],
        ]);
    }
}
