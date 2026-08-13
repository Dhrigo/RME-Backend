<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiagnosisIndicatorMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diagnosis_id' => 'sometimes|required|integer',
            'indicator_code' => 'sometimes|required|string|max:50',
            'indicator_name' => 'sometimes|required|string|max:255',
            'target_score' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }
}
