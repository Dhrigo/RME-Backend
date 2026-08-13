<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMchatAssessmentExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'total_score' => 'nullable|integer',
            'risk_level' => 'nullable|string|max:100',
            'responses_json' => 'nullable|array',
            'recommendation' => 'nullable|string',
            'assessed_at' => 'nullable|date',
        ];
    }
}
