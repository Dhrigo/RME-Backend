<?php

namespace Modules\MedicalRecordSickLeaveCertificate\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SickLeaveCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $certificateId = $this->route('certificate')?->id ?? $this->route('certificate');

        return [
            'letter_number' => ['required', 'string', 'max:255', 'unique:sick_leave_certificates,letter_number,' . $certificateId],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'issue_date' => ['required', 'date'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'duration_days' => ['required', 'integer', 'min:1'],
            'diagnosis' => ['nullable', 'string'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
