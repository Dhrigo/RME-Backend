<?php

namespace Modules\MedicalRecordBloodTransfusionDetail\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BloodTransfusionDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'transfusion_id' => $this->transfusion_id,
            'blood_bag_number' => $this->blood_bag_number,
            'blood_type' => $this->blood_type,
            'volume_ml' => $this->volume_ml,
            'start_time' => $this->start_time?->toISOString(),
            'end_time' => $this->end_time?->toISOString(),
            'reaction_observed' => $this->reaction_observed,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
