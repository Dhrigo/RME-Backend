<?php

namespace Modules\MedicalRecordFluidBalanceAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFluidBalanceAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'shift' => 'nullable|string|in:pagi,siang,malam',
            'assessed_at' => 'sometimes|required|date',
            'total_intake_ml' => 'nullable|numeric|min:0',
            'total_output_ml' => 'nullable|numeric|min:0',
            'balance_ml' => 'nullable|numeric',
        ];
    }
}
