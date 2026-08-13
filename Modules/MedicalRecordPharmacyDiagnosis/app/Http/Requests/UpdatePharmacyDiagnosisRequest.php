<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'prescription_id' => ['nullable', 'integer', 'exists:prescriptions,id'],
            'problem_category' => ['sometimes', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'assessed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'assessed_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
