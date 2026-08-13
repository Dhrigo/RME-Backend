<?php

namespace Modules\PendaftaranPatientEscortContact\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientEscortContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_escort_id' => $this->patient_escort_id,
            'contact_type' => $this->contact_type,
            'contact_value' => $this->contact_value,
            'is_primary' => $this->is_primary,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
