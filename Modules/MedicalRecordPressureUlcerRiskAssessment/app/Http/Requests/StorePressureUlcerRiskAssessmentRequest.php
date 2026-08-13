<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePressureUlcerRiskAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'sensory_perception' => 'nullable|integer|min:1|max:4',
            'moisture' => 'nullable|integer|min:1|max:4',
            'activity' => 'nullable|integer|min:1|max:4',
            'mobility' => 'nullable|integer|min:1|max:4',
            'nutrition' => 'nullable|integer|min:1|max:4',
            'friction_shear' => 'nullable|integer|min:1|max:3',
            'total_score' => 'nullable|integer|min:0|max:23',
            'risk_level' => 'nullable|string|in:no_risk,mild_risk,moderate_risk,high_risk',
            'assessed_at' => 'nullable|date',
        ];
    }
}
