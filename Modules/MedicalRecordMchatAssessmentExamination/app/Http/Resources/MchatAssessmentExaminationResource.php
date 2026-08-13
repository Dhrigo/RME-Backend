<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MchatAssessmentExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'total_score' => $this->total_score,
            'risk_level' => $this->risk_level,
            'responses_json' => $this->responses_json,
            'recommendation' => $this->recommendation,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
