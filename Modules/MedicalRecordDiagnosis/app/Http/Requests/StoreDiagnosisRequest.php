<?php

namespace Modules\MedicalRecordDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_code_id' => ['required', 'integer', 'exists:diagnosis_codes,id'],
            'is_primary' => ['sometimes', 'boolean'],
            'recorded_at' => ['nullable', 'date'],
        ];
    }
}
