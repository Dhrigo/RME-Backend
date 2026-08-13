<?php

namespace Modules\GeneralPatientContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralPatientContact\Models\PatientContact;

class StorePatientContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'contact_type' => ['required', 'string', Rule::in(PatientContact::CONTACT_TYPES)],
            'contact_value' => ['required', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
        ];
    }
}
