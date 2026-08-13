<?php

namespace Modules\PegawaiPracticeLicense\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePracticeLicenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'license_type' => ['required', 'string', 'in:STR,SIP'],
            'license_number' => ['required', 'string', 'max:50', 'unique:practice_licenses,license_number'],
            'issued_at' => ['nullable', 'date'],
            'expires_at' => ['nullable', 'date', 'after:issued_at'],
            'issuing_authority' => ['nullable', 'string', 'max:255'],
        ];
    }
}
