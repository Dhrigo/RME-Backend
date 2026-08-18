<?php

namespace Modules\GeneralPatientFamilyContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientFamilyContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_family_id' => $this->patient_family_id,
            'contact_type' => $this->contact_type,
            'contact_value' => $this->contact_value,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
