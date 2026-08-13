<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterventionIndicatorMappingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'intervention_code' => $this->intervention_code,
            'intervention_name' => $this->intervention_name,
            'indicator_code' => $this->indicator_code,
            'indicator_name' => $this->indicator_name,
            'evaluation_criteria' => $this->evaluation_criteria,
            'is_active' => (bool) $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
