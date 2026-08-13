<?php

namespace Modules\MedicalRecordNursingImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNursingImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nursing_diagnosis_id' => ['sometimes', 'integer', 'exists:nursing_diagnoses,id'],
            'action_taken' => ['nullable', 'string'],
            'performed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'performed_at' => ['sometimes', 'date'],
            'patient_response' => ['nullable', 'string'],
        ];
    }
}
