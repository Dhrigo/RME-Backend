<?php

namespace Modules\MedicalRecordRavenTestExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRavenTestExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'test_form' => 'nullable|string|in:CPM,SPM,APM',
            'raw_score' => 'nullable|integer|min:0|max:60',
            'percentile' => 'nullable|integer|min:0|max:100',
            'iq_grade' => 'nullable|string|max:10',
            'examiner_notes' => 'nullable|string',
            'tested_at' => 'nullable|date',
        ];
    }
}
