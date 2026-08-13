<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingCarePlanImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nursing_care_plan_id' => ['required', 'integer', 'exists:nursing_care_plans,id'],
            'action_taken' => ['nullable', 'string'],
            'performed_by' => ['required', 'integer', 'exists:employees,id'],
            'performed_at' => ['required', 'date'],
            'evaluation' => ['nullable', 'string'],
        ];
    }
}
