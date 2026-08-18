<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientFamilyIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_family_id' => ['sometimes', 'integer', 'exists:patient_families,id'],
            'identity_type' => ['sometimes', 'string', 'max:255'],
            'identity_number' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
