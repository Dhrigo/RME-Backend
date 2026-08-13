<?php

namespace Modules\PasienPatientPortalAccount\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientPortalAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'username' => ['sometimes', 'string', 'max:255', 'unique:patient_portal_accounts,username'],
            'email' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
