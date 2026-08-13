<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNursingCarePlanImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nursing_care_plan_id' => ['sometimes', 'integer', 'exists:nursing_care_plans,id'],
            'action_taken' => ['nullable', 'string'],
            'performed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'performed_at' => ['sometimes', 'date'],
            'evaluation' => ['nullable', 'string'],
        ];
    }
}
