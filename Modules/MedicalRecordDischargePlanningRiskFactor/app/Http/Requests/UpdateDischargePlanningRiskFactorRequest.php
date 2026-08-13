<?php

namespace Modules\MedicalRecordDischargePlanningRiskFactor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDischargePlanningRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'risk_factor' => ['sometimes', 'string', 'max:150'],
            'score' => ['nullable', 'integer'],
            'assessed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'assessed_at' => ['sometimes', 'date'],
        ];
    }
}
