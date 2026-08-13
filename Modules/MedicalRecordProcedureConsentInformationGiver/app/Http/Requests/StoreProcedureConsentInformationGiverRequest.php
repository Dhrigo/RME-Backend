<?php

namespace Modules\MedicalRecordProcedureConsentInformationGiver\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureConsentInformationGiverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'consent_id' => ['required', 'integer', 'exists:doctor_procedure_consents,id'],
            'giver_id' => ['required', 'integer', 'exists:employees,id'],
            'giver_role' => ['nullable','string','max:40'],
            'signed_at' => ['nullable','date'],
        ];
    }
}
