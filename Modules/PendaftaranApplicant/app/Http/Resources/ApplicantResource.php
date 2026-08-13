<?php

namespace Modules\PendaftaranApplicant\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'registration_id' => $this->registration_id,
            'full_name' => $this->full_name,
            'relationship_to_patient' => $this->relationship_to_patient,
            'identity_number' => $this->identity_number,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'application_type' => $this->application_type,
            'application_date' => $this->application_date?->toIso8601String(),
            'notes' => $this->notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
