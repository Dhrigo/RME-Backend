<?php

namespace Modules\GeneralPatient\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_record_number' => ['nullable', 'string', 'max:255', 'unique:patients,medical_record_number'],
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'title_prefix' => ['nullable', 'string', 'max:255'],
            'title_suffix' => ['nullable', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'gender_id' => ['nullable', 'integer', 'exists:genders,id'],
            'religion_id' => ['nullable', 'integer', 'exists:religions,id'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'village_id' => ['nullable', 'integer', 'exists:indonesia_villages,id'],
            'education_id' => ['nullable', 'integer'],
            'occupation_id' => ['nullable', 'integer'],
            'marital_status_id' => ['nullable', 'integer'],
            'blood_type_id' => ['nullable', 'integer'],
            'nationality_id' => ['nullable', 'integer'],
            'ethnicity_id' => ['nullable', 'integer'],
            'language_id' => ['nullable', 'integer'],
            'is_unidentified' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
