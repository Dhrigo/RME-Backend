<?php

namespace Modules\BpjsAplicares\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AplicaresRoomSyncResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'bpjs_room_id' => $this->bpjs_room_id,
            'bed_count' => $this->bed_count,
            'available_count' => $this->available_count,
            'sync_status' => $this->sync_status,
            'sync_message' => $this->sync_message,
            'last_synced_at' => $this->last_synced_at?->toIso8601String(),
        ];
    }
}
