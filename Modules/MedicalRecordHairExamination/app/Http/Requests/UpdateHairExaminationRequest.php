<?php

namespace Modules\MedicalRecordHairExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHairExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'distribution' => 'nullable|string|max:100',
            'texture' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'hair_loss' => 'boolean',
            'scalp_condition' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
