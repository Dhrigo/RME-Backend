<?php

namespace Modules\LayananPatientDeathRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientDeathRecordRequest extends FormRequest
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
            'died_at' => ['required', 'date'],
            'cause_of_death' => ['nullable', 'string'],
            'declared_by' => ['nullable', 'integer', 'exists:employees,id'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
