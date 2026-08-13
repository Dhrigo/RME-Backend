<?php

namespace Modules\LayananPatientDischargeRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientDischargeRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'discharged_at' => ['sometimes', 'date'],
            'discharge_method' => ['sometimes', Rule::in(['healed', 'improved', 'against_medical_advice', 'referred', 'died'])],
            'discharged_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'follow_up_notes' => ['sometimes', 'string'],
        ];
    }
}
