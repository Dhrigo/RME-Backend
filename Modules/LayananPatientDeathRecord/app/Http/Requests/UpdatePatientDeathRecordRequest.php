<?php

namespace Modules\LayananPatientDeathRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientDeathRecordRequest extends FormRequest
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
            'died_at' => ['sometimes', 'date'],
            'cause_of_death' => ['sometimes', 'string'],
            'declared_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'notes' => ['sometimes', 'string'],
        ];
    }
}
