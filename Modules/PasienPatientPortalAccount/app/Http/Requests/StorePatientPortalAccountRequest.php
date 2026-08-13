<?php

namespace Modules\PasienPatientPortalAccount\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientPortalAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'username' => ['required', 'string', 'max:255', 'unique:patient_portal_accounts,username'],
            'email' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
