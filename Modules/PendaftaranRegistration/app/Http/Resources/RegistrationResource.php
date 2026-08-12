<?php

namespace Modules\PendaftaranRegistration\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'registration_number' => $this->registration_number,
            'patient_id' => $this->patient_id,
            'registered_at' => $this->registered_at?->toIso8601String(),
            'admission_diagnosis_id' => $this->admission_diagnosis_id,
            'referral_id' => $this->referral_id,
            'package_id' => $this->package_id,
            'is_emergency' => $this->is_emergency,
            'has_fall_risk' => $this->has_fall_risk,
            'newborn_weight_grams' => $this->newborn_weight_grams,
            'newborn_length_cm' => $this->newborn_length_cm,
            'birth_time' => $this->birth_time,
            'found_location' => $this->found_location,
            'found_at' => $this->found_at?->toIso8601String(),
            'satu_sehat_consent' => $this->satu_sehat_consent,
            'registered_by' => $this->registered_by,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
