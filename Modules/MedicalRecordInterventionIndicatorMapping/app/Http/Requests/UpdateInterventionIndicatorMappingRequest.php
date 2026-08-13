<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterventionIndicatorMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'intervention_code' => 'sometimes|required|string|max:50',
            'intervention_name' => 'sometimes|required|string|max:255',
            'indicator_code' => 'sometimes|required|string|max:50',
            'indicator_name' => 'sometimes|required|string|max:255',
            'evaluation_criteria' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ];
    }
}
