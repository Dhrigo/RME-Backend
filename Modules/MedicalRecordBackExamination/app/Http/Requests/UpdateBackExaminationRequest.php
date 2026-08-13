<?php

namespace Modules\MedicalRecordBackExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBackExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'spine_alignment' => 'nullable|string|max:100',
            'scoliosis' => 'boolean',
            'kyphosis' => 'boolean',
            'lordosis' => 'boolean',
            'tenderness' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
