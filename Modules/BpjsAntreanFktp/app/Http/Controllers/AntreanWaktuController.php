<?php

namespace Modules\BpjsAntreanFktp\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAntreanFktp\Http\Requests\StoreAntreanWaktuRequest;
use Modules\BpjsAntreanFktp\Models\Antrean;
use Modules\BpjsAntreanFktp\Models\AntreanWaktu;

/**
 * Logs the task-timeline state transitions ("Update Waktu Antrean" /
 * antrean/updatewaktu, confirmed spec) and forwards each to BPJS.
 * "List Waktu Task Id" (index) is a local read of that timeline.
 */
class AntreanWaktuController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Antrean $antrean)
    {
        return $antrean->waktus()->orderBy('waktu')->get();
    }

    public function store(StoreAntreanWaktuRequest $request, Antrean $antrean)
    {
        $data = $request->validated();
        $data['waktu'] = $data['waktu'] ?? now();
        $data['antrean_id'] = $antrean->id;

        $waktu = AntreanWaktu::create($data);

        $payload = [
            'kodebooking' => $antrean->kodebooking,
            'taskid' => $waktu->task_id,
            'waktu' => $waktu->waktu->timestamp * 1000,
        ];

        if ($waktu->jenis_resep) {
            $payload['jenisresep'] = $waktu->jenis_resep;
        }

        $response = $this->client->call('antrean_fktp', 'POST', 'antrean/updatewaktu', $payload);
        $success = ($response->metadata->code ?? $response->metaData->code ?? null) == 200;

        $waktu->update([
            'bpjs_sync_status' => $success ? 'synced' : 'failed',
            'bpjs_error' => $success ? null : ($response->metadata->message ?? $response->metaData->message ?? null),
        ]);

        return response()->json($waktu->fresh(), 201);
    }
}
