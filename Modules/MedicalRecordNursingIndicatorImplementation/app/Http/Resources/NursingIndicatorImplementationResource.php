<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NursingIndicatorImplementationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nursing_indicator_id' => $this->nursing_indicator_id,
            'visit_id' => $this->visit_id,
            'value_recorded' => $this->value_recorded,
            'recorded_by' => $this->recorded_by,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
