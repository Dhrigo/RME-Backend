<?php

namespace Modules\MedicalRecordHeadExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeadExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'skull_shape' => 'nullable|string|max:100',
            'hair_distribution' => 'nullable|string|max:100',
            'facial_symmetry' => 'nullable|string|max:50',
            'tenderness' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
