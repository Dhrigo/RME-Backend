<?php

namespace Modules\MedicalRecordHospitalizationCertificate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalizationCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $certificateId = $this->route('certificate')?->id ?? $this->route('certificate');

        return [
            'letter_number' => ['required', 'string', 'max:255', 'unique:hospitalization_certificates,letter_number,' . $certificateId],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'issue_date' => ['required', 'date'],
            'admission_date' => ['nullable', 'date'],
            'estimated_duration_days' => ['nullable', 'integer', 'min:1'],
            'ward_name' => ['nullable', 'string', 'max:255'],
            'diagnosis' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
