<?php

namespace Modules\PendaftaranPatientGuardianContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientGuardianContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_guardian_id' => $this->patient_guardian_id,
            'contact_type' => $this->contact_type,
            'contact_value' => $this->contact_value,
            'is_primary' => $this->is_primary,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
