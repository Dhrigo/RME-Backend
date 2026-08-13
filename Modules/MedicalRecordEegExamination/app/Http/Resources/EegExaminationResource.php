<?php

namespace Modules\MedicalRecordEegExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EegExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'background_rhythm' => $this->background_rhythm,
            'epileptiform_discharges' => (bool) $this->epileptiform_discharges,
            'abnormality_type' => $this->abnormality_type,
            'clinical_correlation' => $this->clinical_correlation,
            'conclusion' => $this->conclusion,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
