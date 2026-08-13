<?php

namespace Modules\MedicalRecordEegExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEegExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'patient_id' => 'sometimes|required|integer',
            'background_rhythm' => 'nullable|string|max:100',
            'epileptiform_discharges' => 'nullable|boolean',
            'abnormality_type' => 'nullable|string|max:100',
            'clinical_correlation' => 'nullable|string',
            'conclusion' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
