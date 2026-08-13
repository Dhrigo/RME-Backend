<?php

namespace Modules\MedicalRecordPalateExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePalateExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'hard_palate' => 'nullable|string|max:100',
            'soft_palate' => 'nullable|string|max:100',
            'uvula_position' => 'nullable|string|max:50',
            'cleft_palate' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
