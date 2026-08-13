<?php

namespace Modules\MedicalRecordFamilyPlanningObstetrics\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyPlanningObstetricsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'patient_id' => $this->patient_id,
            'contraceptive_method' => $this->contraceptive_method,
            'installation_date' => $this->installation_date?->toDateString(),
            'removal_date' => $this->removal_date?->toDateString(),
            'side_effects' => $this->side_effects,
            'action_taken' => $this->action_taken,
            'next_visit_date' => $this->next_visit_date?->toDateString(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
