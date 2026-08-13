<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHumptyDumptyFallScaleAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'age_score' => ['required','integer','between:1,4'],
            'gender_score' => ['required','integer','between:1,3'],
            'diagnosis_score' => ['required','integer','between:1,4'],
            'cognitive_impairment_score' => ['required','integer','between:1,3'],
            'environmental_score' => ['required','integer','between:1,4'],
            'surgery_sedation_score' => ['required','integer','between:1,3'],
            'medication_score' => ['required','integer','between:1,3'],
            'total_score' => ['required','integer','min:7'],
            'risk_level' => ['required','in:LOW,HIGH'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
