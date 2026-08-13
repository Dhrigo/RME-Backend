<?php

namespace Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGetUpAndGoTestAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'time_seconds' => 'required|numeric|min:0',
            'assistive_device' => 'nullable|string|max:50',
            'fall_risk' => 'nullable|string|in:low,medium,high',
            'notes' => 'nullable|string',
            'assessed_at' => 'nullable|date',
        ];
    }
}
