<?php

namespace Modules\PendaftaranBedQueue\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BedQueueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'bed_id' => $this->bed_id,
            'patient_id' => $this->patient_id,
            'queue_number' => $this->queue_number,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
