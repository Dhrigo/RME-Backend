<?php

namespace Modules\MedicalRecordImmunizationVaccination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImmunizationVaccinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'vaccine_name' => ['sometimes', 'string', 'max:150'],
            'dose_number' => ['nullable', 'integer'],
            'batch_number' => ['nullable', 'string', 'max:100'],
            'administered_at' => ['sometimes', 'date'],
            'administered_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'site' => ['nullable', 'string', 'max:100'],
            'route' => ['nullable', 'string', 'max:50'],
            'adverse_reaction' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
