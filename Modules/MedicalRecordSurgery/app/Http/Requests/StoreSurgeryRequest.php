<?php

namespace Modules\MedicalRecordSurgery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSurgeryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_id' => ['nullable', 'integer', 'exists:diagnoses,id'],
            'procedure_name' => ['required', 'string', 'max:255'],
            'surgeon_id' => ['required', 'integer', 'exists:employees,id'],
            'anesthesia_type' => ['nullable', 'string', 'max:255'],
            'started_at' => ['nullable', 'date'],
            'ended_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
