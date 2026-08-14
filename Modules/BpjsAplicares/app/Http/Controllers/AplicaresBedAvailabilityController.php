<?php

namespace Modules\BpjsAplicares\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAplicares\Http\Resources\AplicaresRoomSyncResource;
use Modules\BpjsAplicares\Models\AplicaresRoomSync;
use Modules\BpjsAplicares\Services\AplicaresBedAvailabilityService;

/**
 * "Update Ketersediaan Tempat Tidur" - reads current bed counts from
 * GeneralBed/PendaftaranVisit (via AplicaresBedAvailabilityService) and pushes
 * them to BPJS for an already-registered room. Endpoint path
 * (ruangan/updatetempattidur) inferred - flagged for review.
 */
class AplicaresBedAvailabilityController extends Controller
{
    public function __construct(
        private readonly BpjsClient $client,
        private readonly AplicaresBedAvailabilityService $availability,
    ) {
    }

    public function update(AplicaresRoomSync $aplicares_room_sync)
    {
        if ($aplicares_room_sync->sync_status !== 'registered') {
            return response()->json(['message' => 'Ruangan belum terdaftar di BPJS.'], 422);
        }

        $counts = $this->availability->counts($aplicares_room_sync->room);

        $payload = [
            'kodeRuangan' => $aplicares_room_sync->bpjs_room_id,
            'jumlahTempatTidur' => $counts['bed_count'],
            'jumlahTersedia' => $counts['available_count'],
        ];

        $response = $this->client->call('aplicares', 'POST', 'ruangan/updatetempattidur', $payload);
        $success = ($response->metaData->code ?? null) === '200';

        $aplicares_room_sync->update([
            'bed_count' => $counts['bed_count'],
            'available_count' => $counts['available_count'],
            'sync_status' => $success ? 'synced' : 'failed',
            'sync_message' => $response->metaData->message ?? null,
            'last_synced_at' => now(),
        ]);

        return new AplicaresRoomSyncResource($aplicares_room_sync->fresh());
    }
}
