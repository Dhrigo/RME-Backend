<?php

namespace Modules\MedicalRecordAnamnesis\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnamnesisResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'visit_id' => $this->visit_id,
            'present_illness_history' => $this->present_illness_history,
            'past_medical_history' => $this->past_medical_history,
            'family_medical_history' => $this->family_medical_history,
            'allergy_history' => $this->allergy_history,
            'social_history' => $this->social_history,
            'recorded_by' => $this->recorded_by,
            'recorded_at' => $this->recorded_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
