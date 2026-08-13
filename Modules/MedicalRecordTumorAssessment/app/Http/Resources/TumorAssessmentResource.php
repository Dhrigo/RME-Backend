<?php

namespace Modules\MedicalRecordTumorAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TumorAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'diagnosis_id' => $this->diagnosis_id,
            'assessed_by' => $this->assessed_by,
            'created_by' => $this->created_by,
            'tumor_location' => $this->tumor_location,
            'size_cm' => $this->size_cm,
            'tnm_t' => $this->tnm_t,
            'tnm_n' => $this->tnm_n,
            'tnm_m' => $this->tnm_m,
            'grade' => $this->grade,
            'notes' => $this->notes,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
