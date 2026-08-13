<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFluidBalanceAssessmentDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fluid_balance_assessment_id' => 'required|integer',
            'type' => 'required|string|in:intake,output',
            'category' => 'required|string|max:50',
            'amount_ml' => 'required|numeric|min:0',
            'recorded_at' => 'nullable|date',
        ];
    }
}
