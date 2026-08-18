<?php

namespace Modules\GeneralPatientIdentityCard\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientIdentityCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'id_type' => $this->id_type,
            'id_number' => $this->id_number,
            'issued_at' => $this->issued_at?->toDateString(),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
