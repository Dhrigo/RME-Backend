<?php

namespace Modules\MedicalRecordExternalRiskFactor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExternalRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'factor_type' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'impact_level' => ['nullable', 'string', 'max:20'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
            'recorded_at' => ['required', 'date'],
        ];
    }
}
