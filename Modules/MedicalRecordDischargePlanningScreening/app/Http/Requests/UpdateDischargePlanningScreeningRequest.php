<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDischargePlanningScreeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'screening_criteria' => ['nullable', 'string'],
            'total_score' => ['nullable', 'integer'],
            'requires_planning' => ['sometimes', 'boolean'],
            'screened_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'screened_at' => ['sometimes', 'date'],
        ];
    }
}
