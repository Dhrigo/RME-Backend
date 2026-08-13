<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisIndicatorMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diagnosis_id' => 'required|integer',
            'indicator_code' => 'required|string|max:50',
            'indicator_name' => 'required|string|max:255',
            'target_score' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }
}
