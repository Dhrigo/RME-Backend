<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDischargePlanningScreeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'screening_criteria' => ['nullable', 'string'],
            'total_score' => ['nullable', 'integer'],
            'requires_planning' => ['sometimes', 'boolean'],
            'screened_by' => ['required', 'integer', 'exists:employees,id'],
            'screened_at' => ['required', 'date'],
        ];
    }
}
