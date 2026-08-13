<?php

namespace Modules\BerkasKlaimRadiologyClaim\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RadiologyClaimResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'claim_file_id' => $this->claim_file_id,
            'order_id' => $this->order_id,
            'submitted_at' => $this->submitted_at?->toIso8601String(),
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
