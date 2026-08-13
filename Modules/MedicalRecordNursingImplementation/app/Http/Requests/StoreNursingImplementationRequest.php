<?php

namespace Modules\MedicalRecordNursingImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nursing_diagnosis_id' => ['required', 'integer', 'exists:nursing_diagnoses,id'],
            'action_taken' => ['nullable', 'string'],
            'performed_by' => ['required', 'integer', 'exists:employees,id'],
            'performed_at' => ['required', 'date'],
            'patient_response' => ['nullable', 'string'],
        ];
    }
}
