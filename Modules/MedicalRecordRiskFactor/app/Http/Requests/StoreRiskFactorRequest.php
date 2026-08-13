<?php

namespace Modules\MedicalRecordRiskFactor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'risk_category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'risk_level' => ['nullable', 'string', 'max:20'],
            'identified_by' => ['required', 'integer', 'exists:employees,id'],
            'identified_at' => ['required', 'date'],
            'mitigation_plan' => ['nullable', 'string'],
        ];
    }
}
