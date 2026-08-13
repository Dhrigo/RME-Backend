<?php

namespace Modules\MedicalRecordChestExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChestExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'inspection' => 'nullable|string',
            'palpation' => 'nullable|string',
            'percussion' => 'nullable|string',
            'auscultation_breath_sounds' => 'nullable|string|max:100',
            'auscultation_heart_sounds' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
