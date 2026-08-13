<?php

namespace Modules\PendaftaranPatientEscortIdentityCard\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientEscortIdentityCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_escort_id' => $this->patient_escort_id,
            'card_type' => $this->card_type,
            'card_number' => $this->card_number,
            'issued_date' => $this->issued_date?->toDateString(),
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'postal_code' => $this->postal_code,
            'region_code' => $this->region_code,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
