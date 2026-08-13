<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InhalantAllergenExaminationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'allergen_name' => $this->allergen_name,
            'reaction_grade' => $this->reaction_grade,
            'wheal_diameter_mm' => $this->wheal_diameter_mm,
            'erythema_diameter_mm' => $this->erythema_diameter_mm,
            'interpretation' => $this->interpretation,
            'examined_at' => $this->examined_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
