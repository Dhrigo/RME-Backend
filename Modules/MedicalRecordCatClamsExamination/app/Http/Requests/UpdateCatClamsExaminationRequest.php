<?php

namespace Modules\MedicalRecordCatClamsExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatClamsExaminationRequest extends FormRequest
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
            'cat_score' => 'nullable|numeric',
            'clams_score' => 'nullable|numeric',
            'developmental_quotient' => 'nullable|numeric',
            'developmental_age_months' => 'nullable|numeric',
            'interpretation' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
