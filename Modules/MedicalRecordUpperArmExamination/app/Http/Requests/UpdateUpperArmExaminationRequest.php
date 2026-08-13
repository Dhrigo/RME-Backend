<?php

namespace Modules\MedicalRecordUpperArmExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUpperArmExaminationRequest extends FormRequest
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
            'range_of_motion' => 'nullable|string|max:100',
            'deformity' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
