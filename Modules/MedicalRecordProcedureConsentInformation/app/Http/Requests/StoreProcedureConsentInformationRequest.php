<?php

namespace Modules\MedicalRecordProcedureConsentInformation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureConsentInformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'consent_id' => ['required', 'integer', 'exists:doctor_procedure_consents,id'],
            'explained_by' => ['required', 'integer', 'exists:employees,id'],
            'diagnosis_explanation' => ['nullable','string'],
            'procedure_explanation' => ['nullable','string'],
            'purpose' => ['nullable','string'],
            'risks_and_complications' => ['nullable','string'],
            'alternative_procedures' => ['nullable','string'],
            'prognosis' => ['nullable','string'],
            'explained_at' => ['nullable','date'],
        ];
    }
}
