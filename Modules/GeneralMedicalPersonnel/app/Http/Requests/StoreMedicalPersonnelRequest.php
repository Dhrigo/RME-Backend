<?php

namespace Modules\GeneralMedicalPersonnel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalPersonnelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identity_number' => ['nullable', 'string', 'max:255', 'unique:medical_personnel,identity_number'],
            'name' => ['required', 'string', 'max:255'],
            'personnel_type' => ['required', 'string', 'max:255'],
            'profession_id' => ['nullable', 'integer', 'exists:professions,id'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
