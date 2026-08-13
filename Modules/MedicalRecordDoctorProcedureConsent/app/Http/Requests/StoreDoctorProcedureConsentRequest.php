<?php

namespace Modules\MedicalRecordDoctorProcedureConsent\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorProcedureConsentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'procedure_name' => ['required','string','max:255'],
            'indication' => ['nullable','string'],
            'consent_decision' => ['nullable','in:pending,agree,refuse'],
            'signed_at' => ['nullable','date'],
        ];
    }
}
