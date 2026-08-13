<?php

namespace Modules\MedicalRecordBirthCertificateLetter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BirthCertificateLetterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $letterId = $this->route('letter')?->id ?? $this->route('letter');

        return [
            'letter_number' => ['required', 'string', 'max:255', 'unique:birth_certificate_letters,letter_number,' . $letterId],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'mother_patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'issue_date' => ['required', 'date'],
            'child_name' => ['nullable', 'string', 'max:255'],
            'birth_date_time' => ['nullable', 'date'],
            'birth_weight_grams' => ['nullable', 'integer', 'min:0'],
            'birth_length_cm' => ['nullable', 'numeric', 'min:0'],
            'gender' => ['nullable', 'string', 'max:50'],
            'remarks' => ['nullable', 'string'],
        ];
    }
}
