<?php

namespace Modules\GeneralPatientFamilyContact\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientFamilyContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_family_id' => ['sometimes', 'integer', 'exists:patient_families,id'],
            'contact_type' => ['sometimes', 'string', 'max:255'],
            'contact_value' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
