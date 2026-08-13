<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionIndicatorMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'intervention_code' => 'required|string|max:50',
            'intervention_name' => 'required|string|max:255',
            'indicator_code' => 'required|string|max:50',
            'indicator_name' => 'required|string|max:255',
            'evaluation_criteria' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }
}
