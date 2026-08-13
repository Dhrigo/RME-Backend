<?php

namespace Modules\MedicalRecordClinicalNoteVerification\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicalNoteVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clinical_note_id' => ['required', 'integer', 'exists:clinical_notes,id'],
            'verifier_doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'verification_status' => ['nullable', 'string', 'max:100'],
            'verified_at' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
