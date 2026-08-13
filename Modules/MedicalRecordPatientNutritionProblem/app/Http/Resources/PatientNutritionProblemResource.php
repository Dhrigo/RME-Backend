<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientNutritionProblemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'identified_by' => $this->identified_by,
            'created_by' => $this->created_by,
            'problem_category' => $this->problem_category,
            'problem_description' => $this->problem_description,
            'intervention_plan' => $this->intervention_plan,
            'status' => $this->status,
            'identified_at' => $this->identified_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
