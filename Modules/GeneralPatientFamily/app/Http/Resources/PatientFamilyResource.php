<?php

namespace Modules\GeneralPatientFamily\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientFamilyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'name' => $this->name,
            'relationship' => $this->relationship,
            'birth_date' => $this->birth_date?->toDateString(),
            'gender_id' => $this->gender_id,
            'education_id' => $this->education_id,
            'occupation_id' => $this->occupation_id,
            'address' => $this->address,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'postal_code' => $this->postal_code,
            'village_id' => $this->village_id,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
