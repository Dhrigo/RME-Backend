<?php

namespace Modules\MedicalRecordCatClamsExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatClamsExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'cat_score' => $this->cat_score,
            'clams_score' => $this->clams_score,
            'developmental_quotient' => $this->developmental_quotient,
            'developmental_age_months' => $this->developmental_age_months,
            'interpretation' => $this->interpretation,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
