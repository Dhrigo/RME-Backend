<?php

namespace Modules\PendaftaranPatientGuardian\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;

class UpdatePatientGuardianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['sometimes', 'string', 'max:255'],
            'relationship_to_patient' => ['sometimes', Rule::in(PatientGuardian::RELATIONSHIP_TYPES)],
            'identity_number' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
