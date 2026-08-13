<?php

namespace Modules\MedicalRecordDifferentialDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDifferentialDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'diagnosis_code_id' => ['nullable', 'integer', 'exists:diagnosis_codes,id'],
            'description' => ['sometimes', 'string', 'max:255'],
            'rank' => ['nullable', 'integer'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
