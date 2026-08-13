<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PressureUlcerRiskAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'sensory_perception' => $this->sensory_perception,
            'moisture' => $this->moisture,
            'activity' => $this->activity,
            'mobility' => $this->mobility,
            'nutrition' => $this->nutrition,
            'friction_shear' => $this->friction_shear,
            'total_score' => $this->total_score,
            'risk_level' => $this->risk_level,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
