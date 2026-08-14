<?php

namespace Modules\BpjsAplicares\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsAplicares\Http\Requests\StoreAplicaresRoomRequest;
use Modules\BpjsAplicares\Http\Resources\AplicaresRoomSyncResource;
use Modules\BpjsAplicares\Models\AplicaresRoomSync;
use Modules\GeneralRoom\Models\Room;

/**
 * "Ruangan Baru" (register) and "Hapus Ruangan" (deregister) - registers/
 * deregisters a local Room with BPJS Aplicares and tracks the outcome in
 * AplicaresRoomSync. Endpoint paths (ruangan/insert, ruangan/delete) inferred
 * from BPJS's documented Aplicares naming convention - flagged for review.
 */
class AplicaresRoomController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Request $request)
    {
        return AplicaresRoomSyncResource::collection(
            AplicaresRoomSync::query()->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreAplicaresRoomRequest $request)
    {
        $room = Room::findOrFail($request->integer('room_id'));

        $sync = AplicaresRoomSync::firstOrNew(['room_id' => $room->id]);
        $sync->sync_status = 'pending';

        $payload = [
            'kodeRuangan' => (string) $room->id,
            'namaRuangan' => $room->room_number,
            'kodeKelas' => $room->class_id,
        ];

        $response = $this->client->call('aplicares', 'POST', 'ruangan/insert', $payload);
        $success = ($response->metaData->code ?? null) === '200';

        $sync->bpjs_room_id = $success ? ($response->response->kodeRuangan ?? null) : $sync->bpjs_room_id;
        $sync->sync_status = $success ? 'registered' : 'failed';
        $sync->sync_message = $response->metaData->message ?? null;
        $sync->last_synced_at = now();
        $sync->save();

        return (new AplicaresRoomSyncResource($sync))->response()->setStatusCode(201);
    }

    public function show(AplicaresRoomSync $aplicares_room_sync): object
    {
        return $this->client->call('aplicares', 'GET', 'ruangan/'.$aplicares_room_sync->bpjs_room_id);
    }

    public function destroy(AplicaresRoomSync $aplicares_room_sync)
    {
        $response = $this->client->call('aplicares', 'DELETE', 'ruangan/delete/'.$aplicares_room_sync->bpjs_room_id);
        $success = ($response->metaData->code ?? null) === '200';

        if (! $success) {
            return response()->json(['message' => $response->metaData->message ?? 'Gagal menghapus ruangan di BPJS.'], 422);
        }

        $aplicares_room_sync->update(['sync_status' => 'deleted', 'sync_message' => null, 'last_synced_at' => now()]);

        return response()->json(null, 204);
    }
}
