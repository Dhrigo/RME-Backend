<?php

namespace Modules\MedicalRecordNursingDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_label' => ['required', 'string', 'max:150'],
            'related_factors' => ['nullable', 'string'],
            'defining_characteristics' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'max:20'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
            'recorded_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
