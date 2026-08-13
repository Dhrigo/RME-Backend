<?php

namespace Modules\MedicalRecordPreAnesthesiaSedationAssessment\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PreAnesthesiaSedationAssessmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'doctor_id' => $this->doctor_id,
            'created_by' => $this->created_by,
            'asa_classification' => $this->asa_classification,
            'mallampati_class' => $this->mallampati_class,
            'npo_hours' => $this->npo_hours,
            'comorbidities' => $this->comorbidities,
            'planned_anesthesia_type' => $this->planned_anesthesia_type,
            'risk_notes' => $this->risk_notes,
            'assessed_at' => $this->assessed_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
