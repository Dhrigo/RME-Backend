<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientFamilyEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'topic' => ['sometimes', 'string', 'max:150'],
            'method' => ['nullable', 'string', 'max:50'],
            'barrier' => ['nullable', 'string'],
            'understanding_level' => ['nullable', 'string', 'max:50'],
            're_education_needed' => ['sometimes', 'boolean'],
            'educator_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'educated_at' => ['sometimes', 'date'],
        ];
    }
}
