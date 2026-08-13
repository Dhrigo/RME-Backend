<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientFamilyEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'topic' => ['required', 'string', 'max:150'],
            'method' => ['nullable', 'string', 'max:50'],
            'barrier' => ['nullable', 'string'],
            'understanding_level' => ['nullable', 'string', 'max:50'],
            're_education_needed' => ['sometimes', 'boolean'],
            'educator_id' => ['required', 'integer', 'exists:employees,id'],
            'educated_at' => ['required', 'date'],
        ];
    }
}
