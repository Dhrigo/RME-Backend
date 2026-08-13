<?php

namespace Modules\MedicalRecordLipExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLipExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'color' => 'nullable|string|max:100',
            'symmetry' => 'nullable|string|max:100',
            'lesions' => 'nullable|string|max:255',
            'moisture' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
