<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'prescription_id' => ['nullable', 'integer', 'exists:prescriptions,id'],
            'problem_category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'assessed_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
