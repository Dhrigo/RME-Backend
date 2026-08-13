<?php

namespace Modules\MedicalRecordImmunizationVaccination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImmunizationVaccinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'vaccine_name' => ['required', 'string', 'max:150'],
            'dose_number' => ['nullable', 'integer'],
            'batch_number' => ['nullable', 'string', 'max:100'],
            'administered_at' => ['required', 'date'],
            'administered_by' => ['required', 'integer', 'exists:employees,id'],
            'site' => ['nullable', 'string', 'max:100'],
            'route' => ['nullable', 'string', 'max:50'],
            'adverse_reaction' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
