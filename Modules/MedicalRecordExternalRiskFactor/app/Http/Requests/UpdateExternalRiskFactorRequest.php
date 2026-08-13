<?php

namespace Modules\MedicalRecordExternalRiskFactor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExternalRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'factor_type' => ['sometimes', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'impact_level' => ['nullable', 'string', 'max:20'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}
