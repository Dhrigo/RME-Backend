<?php

namespace Modules\PendaftaranPatientEscortContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientEscortContact\Models\PatientEscortContact;

class UpdatePatientEscortContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'contact_type' => ['sometimes', Rule::in(PatientEscortContact::CONTACT_TYPES)],
            'contact_value' => ['sometimes', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
        ];
    }
}
