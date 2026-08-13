<?php

namespace Modules\MedicalRecordPhysicalAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhysicalAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'mobility_status' => $this->mobility_status,
            'adl_status' => $this->adl_status,
            'cognitive_status' => $this->cognitive_status,
            'nutritional_risk' => $this->nutritional_risk,
            'pain_level' => $this->pain_level,
            'notes' => $this->notes,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
