<?php

namespace Modules\PendaftaranRegistration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_number' => ['nullable', 'string', 'max:255', 'unique:registrations,registration_number'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'registered_at' => ['nullable', 'date'],
            'admission_diagnosis_id' => ['nullable', 'integer', 'exists:diagnosis_codes,id'],
            'referral_id' => ['nullable', 'integer'],
            'package_id' => ['nullable', 'integer'],
            'is_emergency' => ['sometimes', 'boolean'],
            'has_fall_risk' => ['sometimes', 'boolean'],
            'newborn_weight_grams' => ['nullable', 'numeric'],
            'newborn_length_cm' => ['nullable', 'numeric'],
            'birth_time' => ['nullable', 'date_format:H:i'],
            'found_location' => ['nullable', 'string', 'max:255'],
            'found_at' => ['nullable', 'date'],
            'satu_sehat_consent' => ['sometimes', 'boolean'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
