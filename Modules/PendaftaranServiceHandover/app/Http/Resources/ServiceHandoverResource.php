<?php

namespace Modules\PendaftaranServiceHandover\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceHandoverResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'ward_id' => $this->ward_id,
            'handed_over_by' => $this->handed_over_by,
            'received_by' => $this->received_by,
            'handed_over_at' => $this->handed_over_at?->toIso8601String(),
            'received_at' => $this->received_at?->toIso8601String(),
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
