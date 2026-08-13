<?php

namespace Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGetUpAndGoTestAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'time_seconds' => 'sometimes|required|numeric|min:0',
            'assistive_device' => 'nullable|string|max:50',
            'fall_risk' => 'nullable|string|in:low,medium,high',
            'notes' => 'nullable|string',
            'assessed_at' => 'nullable|date',
        ];
    }
}
