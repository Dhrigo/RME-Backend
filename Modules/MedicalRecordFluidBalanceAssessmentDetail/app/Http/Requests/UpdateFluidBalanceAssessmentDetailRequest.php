<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFluidBalanceAssessmentDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fluid_balance_assessment_id' => 'sometimes|required|integer',
            'type' => 'sometimes|required|string|in:intake,output',
            'category' => 'sometimes|required|string|max:50',
            'amount_ml' => 'sometimes|required|numeric|min:0',
            'recorded_at' => 'nullable|date',
        ];
    }
}
