<?php

namespace Modules\LayananPatientDischargeRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePatientDischargeRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'discharged_at' => ['required', 'date'],
            'discharge_method' => ['required', Rule::in(['healed', 'improved', 'against_medical_advice', 'referred', 'died'])],
            'discharged_by' => ['nullable', 'integer', 'exists:employees,id'],
            'follow_up_notes' => ['nullable', 'string'],
        ];
    }
}
