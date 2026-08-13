<?php

namespace Modules\GeneralMedicalPersonnel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicalPersonnelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identity_number' => ['nullable', 'string', 'max:255', Rule::unique('medical_personnel', 'identity_number')->ignore($this->route('medical_personnel'))],
            'name' => ['sometimes', 'string', 'max:255'],
            'personnel_type' => ['sometimes', 'string', 'max:255'],
            'profession_id' => ['nullable', 'integer', 'exists:professions,id'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
