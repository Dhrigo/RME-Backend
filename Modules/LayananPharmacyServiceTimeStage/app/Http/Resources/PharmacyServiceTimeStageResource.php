<?php

namespace Modules\LayananPharmacyServiceTimeStage\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyServiceTimeStageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pharmacy_service_time_id' => $this->pharmacy_service_time_id,
            'stage_name' => $this->stage_name,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'recorded_by' => $this->recorded_by,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
