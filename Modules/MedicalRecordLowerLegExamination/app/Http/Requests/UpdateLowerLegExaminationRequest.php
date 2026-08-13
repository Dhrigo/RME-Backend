<?php

namespace Modules\MedicalRecordLowerLegExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLowerLegExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'side' => 'nullable|string|in:left,right,bilateral',
            'muscle_strength' => 'nullable|string|max:10',
            'edema' => 'boolean',
            'pulses' => 'nullable|string|max:50',
            'skin_condition' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
