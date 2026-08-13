<?php

namespace Modules\PendaftaranPatientGuardianContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientGuardianContact\Models\PatientGuardianContact;

class StorePatientGuardianContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_guardian_id' => ['required', 'integer', 'exists:patient_guardians,id'],
            'contact_type' => ['required', Rule::in(PatientGuardianContact::CONTACT_TYPES)],
            'contact_value' => ['required', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
        ];
    }
}
