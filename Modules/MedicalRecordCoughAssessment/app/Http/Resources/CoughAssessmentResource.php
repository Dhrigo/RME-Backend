<?php

namespace Modules\MedicalRecordCoughAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoughAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'has_cough' => $this->has_cough,
            'duration_weeks' => $this->duration_weeks,
            'cough_type' => $this->cough_type,
            'other_symptoms' => $this->other_symptoms,
            'is_referred_tb_screening' => $this->is_referred_tb_screening,
            'assessed_by' => $this->assessed_by,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
