<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientFamilyIdentityCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_family_id' => $this->patient_family_id,
            'identity_type' => $this->identity_type,
            'identity_number' => $this->identity_number,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
