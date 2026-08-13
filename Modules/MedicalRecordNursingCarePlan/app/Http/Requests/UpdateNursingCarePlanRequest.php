<?php

namespace Modules\MedicalRecordNursingCarePlan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNursingCarePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'assessment' => ['nullable', 'string'],
            'goal' => ['nullable', 'string'],
            'intervention_plan' => ['nullable', 'string'],
            'target_date' => ['nullable', 'date'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
