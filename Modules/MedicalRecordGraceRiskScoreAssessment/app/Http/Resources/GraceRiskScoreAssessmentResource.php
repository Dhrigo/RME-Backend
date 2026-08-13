<?php

namespace Modules\MedicalRecordGraceRiskScoreAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GraceRiskScoreAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'age' => $this->age,
            'heart_rate' => $this->heart_rate,
            'systolic_bp' => $this->systolic_bp,
            'creatinine_mg_dl' => $this->creatinine_mg_dl,
            'cardiac_arrest_at_admission' => $this->cardiac_arrest_at_admission,
            'st_segment_deviation' => $this->st_segment_deviation,
            'elevated_cardiac_enzymes' => $this->elevated_cardiac_enzymes,
            'killip_class' => $this->killip_class,
            'total_score' => $this->total_score,
            'risk_category' => $this->risk_category,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
