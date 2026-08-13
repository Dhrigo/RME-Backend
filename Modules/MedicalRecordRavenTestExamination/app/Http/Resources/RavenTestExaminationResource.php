<?php

namespace Modules\MedicalRecordRavenTestExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RavenTestExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'test_form' => $this->test_form,
            'raw_score' => $this->raw_score,
            'percentile' => $this->percentile,
            'iq_grade' => $this->iq_grade,
            'examiner_notes' => $this->examiner_notes,
            'tested_at' => $this->tested_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
