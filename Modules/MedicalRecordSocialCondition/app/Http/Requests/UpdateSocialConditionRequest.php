<?php

namespace Modules\MedicalRecordSocialCondition\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialConditionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'living_situation' => ['nullable', 'string', 'max:150'],
            'occupation_status' => ['nullable', 'string', 'max:100'],
            'financial_status' => ['nullable', 'string', 'max:100'],
            'support_system' => ['nullable', 'string'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}
