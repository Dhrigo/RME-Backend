<?php

namespace Modules\PendaftaranPatientGuardian\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;

class StorePatientGuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'integer', 'exists:registrations,id'],
            'full_name' => ['required', 'string', 'max:255'],
            'relationship_to_patient' => ['required', Rule::in(PatientGuardian::RELATIONSHIP_TYPES)],
            'identity_number' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
        ];
    }
}
