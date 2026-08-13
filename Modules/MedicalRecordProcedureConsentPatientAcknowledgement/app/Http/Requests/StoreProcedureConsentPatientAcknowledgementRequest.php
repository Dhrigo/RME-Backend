<?php

namespace Modules\MedicalRecordProcedureConsentPatientAcknowledgement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureConsentPatientAcknowledgementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'consent_id' => ['required', 'integer', 'exists:doctor_procedure_consents,id'],
            'acknowledger_name' => ['required','string','max:255'],
            'relationship_to_patient' => ['nullable','string','max:40'],
            'decision' => ['required','in:agree,refuse'],
            'signed_at' => ['nullable','date'],
        ];
    }
}
