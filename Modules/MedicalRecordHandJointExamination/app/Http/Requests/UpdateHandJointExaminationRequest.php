<?php

namespace Modules\MedicalRecordHandJointExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHandJointExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'joint' => 'nullable|string|in:wrist,finger,elbow',
            'range_of_motion' => 'nullable|string|max:100',
            'swelling' => 'boolean',
            'tenderness' => 'boolean',
            'deformity' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
