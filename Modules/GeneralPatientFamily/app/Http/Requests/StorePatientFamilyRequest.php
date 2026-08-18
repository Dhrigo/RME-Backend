<?php

namespace Modules\GeneralPatientFamily\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientFamilyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'name' => ['required', 'string', 'max:255'],
            'relationship' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'gender_id' => ['nullable', 'integer', 'exists:genders,id'],
            'education_id' => ['nullable', 'integer'],
            'occupation_id' => ['nullable', 'integer'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'village_id' => ['nullable', 'integer', 'exists:indonesia_villages,id'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
