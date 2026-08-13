<?php

namespace Modules\MedicalRecordNursingDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNursingDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'diagnosis_label' => ['sometimes', 'string', 'max:150'],
            'related_factors' => ['nullable', 'string'],
            'defining_characteristics' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'max:20'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
