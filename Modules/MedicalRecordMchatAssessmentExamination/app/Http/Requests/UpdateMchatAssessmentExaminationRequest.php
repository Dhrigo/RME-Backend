<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMchatAssessmentExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'patient_id' => 'sometimes|required|integer',
            'total_score' => 'nullable|integer',
            'risk_level' => 'nullable|string|max:100',
            'responses_json' => 'nullable|array',
            'recommendation' => 'nullable|string',
            'assessed_at' => 'nullable|date',
        ];
    }
}
