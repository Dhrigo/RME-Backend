<?php

namespace Modules\MedicalRecordDifferentialDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDifferentialDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_code_id' => ['nullable', 'integer', 'exists:diagnosis_codes,id'],
            'description' => ['required', 'string', 'max:255'],
            'rank' => ['nullable', 'integer'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
            'recorded_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
