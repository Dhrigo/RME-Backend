<?php

namespace Modules\MedicalRecordGraceRiskScoreAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGraceRiskScoreAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'age' => 'sometimes|required|integer|min:0|max:120',
            'heart_rate' => 'sometimes|required|integer|min:0|max:300',
            'systolic_bp' => 'sometimes|required|integer|min:0|max:300',
            'creatinine_mg_dl' => 'sometimes|required|numeric|min:0',
            'cardiac_arrest_at_admission' => 'boolean',
            'st_segment_deviation' => 'boolean',
            'elevated_cardiac_enzymes' => 'boolean',
            'killip_class' => 'nullable|integer|min:1|max:4',
            'total_score' => 'nullable|integer|min:0',
            'risk_category' => 'nullable|string|in:low,intermediate,high',
            'assessed_at' => 'nullable|date',
        ];
    }
}
