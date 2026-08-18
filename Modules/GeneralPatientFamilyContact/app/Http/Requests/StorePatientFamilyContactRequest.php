<?php

namespace Modules\GeneralPatientFamilyContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientFamilyContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_family_id' => ['required', 'integer', 'exists:patient_families,id'],
            'contact_type' => ['required', 'string', 'max:255'],
            'contact_value' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
