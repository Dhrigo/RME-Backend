<?php

namespace Modules\PendaftaranWardQueue\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WardQueueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ward_id' => $this->ward_id,
            'queue_number' => $this->queue_number,
            'visit_id' => $this->visit_id,
            'called_at' => $this->called_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
