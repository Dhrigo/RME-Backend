<?php

namespace Modules\MedicalRecordPediatricStatus\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PediatricStatusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'visit_id' => $this->visit_id,
            'birth_weight_grams' => $this->birth_weight_grams,
            'birth_length_cm' => $this->birth_length_cm,
            'head_circumference_cm' => $this->head_circumference_cm,
            'gestational_age_weeks' => $this->gestational_age_weeks,
            'immunization_status' => $this->immunization_status,
            'developmental_milestones' => $this->developmental_milestones,
            'notes' => $this->notes,
            'recorded_at' => $this->recorded_at?->toISOString(),
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
