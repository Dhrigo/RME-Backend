<?php

namespace Modules\MedicalRecordDischargePlanningRiskFactor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDischargePlanningRiskFactorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'risk_factor' => ['required', 'string', 'max:150'],
            'score' => ['nullable', 'integer'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'assessed_at' => ['required', 'date'],
        ];
    }
}
