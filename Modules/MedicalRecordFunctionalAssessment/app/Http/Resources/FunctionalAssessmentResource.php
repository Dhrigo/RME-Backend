<?php

namespace Modules\MedicalRecordFunctionalAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FunctionalAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'assessment_date' => $this->assessment_date?->toIso8601String(),
            'mobility_status' => $this->mobility_status,
            'adl_score' => $this->adl_score,
            'assistive_device' => $this->assistive_device,
            'assessed_by' => $this->assessed_by,
            'notes' => $this->notes,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
