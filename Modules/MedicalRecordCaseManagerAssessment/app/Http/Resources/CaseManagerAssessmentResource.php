<?php

namespace Modules\MedicalRecordCaseManagerAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseManagerAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'case_manager_id' => $this->case_manager_id,
            'screening_criteria' => $this->screening_criteria,
            'risk_level' => $this->risk_level,
            'care_plan' => $this->care_plan,
            'follow_up_needed' => $this->follow_up_needed,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
