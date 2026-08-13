<?php

namespace Modules\MedicalRecordFunctionalAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFunctionalAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'assessment_date' => ['required', 'date'],
            'mobility_status' => ['nullable', 'string', 'max:100'],
            'adl_score' => ['nullable', 'integer'],
            'assistive_device' => ['nullable', 'string', 'max:100'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
