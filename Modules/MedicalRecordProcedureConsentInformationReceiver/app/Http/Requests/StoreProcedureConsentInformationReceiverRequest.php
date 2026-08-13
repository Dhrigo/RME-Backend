<?php

namespace Modules\MedicalRecordProcedureConsentInformationReceiver\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureConsentInformationReceiverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'consent_id' => ['required', 'integer', 'exists:doctor_procedure_consents,id'],
            'receiver_name' => ['required','string','max:255'],
            'receiver_relationship' => ['nullable','string','max:40'],
            'signed_at' => ['nullable','date'],
        ];
    }
}
