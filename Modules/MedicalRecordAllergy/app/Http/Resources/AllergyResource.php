<?php

namespace Modules\MedicalRecordAllergy\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllergyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'category' => $this->category,
            'allergen' => $this->allergen,
            'reaction' => $this->reaction,
            'severity' => $this->severity,
            'is_active' => $this->is_active,
            'recorded_by' => $this->recorded_by,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
