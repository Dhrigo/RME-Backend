<?php

namespace Modules\MedicalRecordCoughAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoughAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'has_cough' => ['sometimes', 'boolean'],
            'duration_weeks' => ['nullable', 'integer'],
            'cough_type' => ['nullable', 'string', 'max:50'],
            'other_symptoms' => ['nullable', 'string'],
            'is_referred_tb_screening' => ['sometimes', 'boolean'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'assessed_at' => ['required', 'date'],
        ];
    }
}
