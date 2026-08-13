<?php

namespace Modules\MedicalRecordInpatientCarePlan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInpatientCarePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'planned_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'care_goals' => ['required','string'],
            'planned_length_of_stay_days' => ['nullable','integer','min:1'],
            'discharge_criteria' => ['nullable','string'],
            'status' => ['nullable','in:active,completed,revised'],
            'planned_at' => ['nullable','date'],
        ];
    }
}
