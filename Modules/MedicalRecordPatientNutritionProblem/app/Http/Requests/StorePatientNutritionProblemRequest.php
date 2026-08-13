<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientNutritionProblemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'identified_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'problem_category' => ['required','string','max:40'],
            'problem_description' => ['required','string'],
            'intervention_plan' => ['nullable','string'],
            'status' => ['nullable','in:open,in_progress,resolved'],
            'identified_at' => ['nullable','date'],
        ];
    }
}
