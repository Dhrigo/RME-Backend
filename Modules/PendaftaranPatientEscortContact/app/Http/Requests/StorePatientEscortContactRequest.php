<?php

namespace Modules\PendaftaranPatientEscortContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientEscortContact\Models\PatientEscortContact;

class StorePatientEscortContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_escort_id' => ['required', 'integer', 'exists:patient_escorts,id'],
            'contact_type' => ['required', Rule::in(PatientEscortContact::CONTACT_TYPES)],
            'contact_value' => ['required', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
        ];
    }
}
