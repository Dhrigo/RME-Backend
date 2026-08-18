<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientFamilyIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_family_id' => ['required', 'integer', 'exists:patient_families,id'],
            'identity_type' => ['required', 'string', 'max:255'],
            'identity_number' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
