<?php

namespace Modules\GeneralWardTransferRoute\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WardTransferRouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'from_ward_id' => $this->from_ward_id,
            'to_ward_id' => $this->to_ward_id,
            'requires_approval' => $this->requires_approval,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
