<?php

namespace Modules\MedicalRecordHealthCertificate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $certificateId = $this->route('certificate')?->id ?? $this->route('certificate');

        return [
            'letter_number' => ['required', 'string', 'max:255', 'unique:health_certificates,letter_number,' . $certificateId],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'issue_date' => ['required', 'date'],
            'physical_fitness_status' => ['nullable', 'string', 'max:255'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'blood_pressure' => ['nullable', 'string', 'max:50'],
            'height_cm' => ['nullable', 'numeric', 'min:0'],
            'weight_kg' => ['nullable', 'numeric', 'min:0'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
