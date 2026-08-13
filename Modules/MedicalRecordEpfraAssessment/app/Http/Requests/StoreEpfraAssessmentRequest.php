<?php

namespace Modules\MedicalRecordEpfraAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEpfraAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'assessor_id' => 'nullable|integer',
            'criteria_notes' => 'nullable|string',
            'score' => 'nullable|integer|min:0',
            'risk_level' => 'nullable|string|in:low,medium,high',
            'assessed_at' => 'nullable|date',
        ];
    }
}
