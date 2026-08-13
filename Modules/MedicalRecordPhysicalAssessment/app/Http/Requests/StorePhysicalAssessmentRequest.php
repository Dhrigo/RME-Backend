<?php

namespace Modules\MedicalRecordPhysicalAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhysicalAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'mobility_status' => 'nullable|string|max:50',
            'adl_status' => 'nullable|string|max:50',
            'cognitive_status' => 'nullable|string|max:50',
            'nutritional_risk' => 'nullable|string|in:low,medium,high',
            'pain_level' => 'nullable|integer|min:0|max:10',
            'notes' => 'nullable|string',
            'assessed_at' => 'nullable|date',
        ];
    }
}
