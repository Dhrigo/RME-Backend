<?php

namespace Modules\MedicalRecordFluidFinalBalance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFluidFinalBalanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'period_date' => ['sometimes', 'date'],
            'total_intake_ml' => ['sometimes', 'numeric'],
            'total_output_ml' => ['sometimes', 'numeric'],
            'balance_ml' => ['nullable', 'numeric'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}
