<?php

namespace Modules\GeneralAdmissionDiagnosis\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmissionDiagnosisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'diagnosis_code_id' => $this->diagnosis_code_id,
            'diagnosis_text' => $this->diagnosis_text,
            'is_primary' => $this->is_primary,
            'diagnosed_at' => $this->diagnosed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
