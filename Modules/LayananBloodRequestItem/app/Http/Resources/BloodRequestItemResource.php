<?php

namespace Modules\LayananBloodRequestItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BloodRequestItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'blood_transfusion_id' => $this->blood_transfusion_id,
            'blood_component' => $this->blood_component,
            'blood_type' => $this->blood_type,
            'bag_quantity' => $this->bag_quantity,
            'cross_match_result' => $this->cross_match_result,
            'status' => $this->status,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
