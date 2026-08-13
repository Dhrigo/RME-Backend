<?php

namespace Modules\MedicalRecordRiskFactor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'risk_category' => ['sometimes', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'risk_level' => ['nullable', 'string', 'max:20'],
            'identified_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'identified_at' => ['sometimes', 'date'],
            'mitigation_plan' => ['nullable', 'string'],
        ];
    }
}
