<?php

namespace Modules\MedicalRecordCaseManagerAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCaseManagerAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'case_manager_id' => 'nullable|integer',
            'screening_criteria' => 'nullable|string',
            'risk_level' => 'nullable|string|in:low,medium,high',
            'care_plan' => 'nullable|string',
            'follow_up_needed' => 'boolean',
            'assessed_at' => 'nullable|date',
        ];
    }
}
