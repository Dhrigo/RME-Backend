<?php

namespace Modules\MedicalRecordAbciProcedure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbciProcedureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
            'procedure_date' => ['required', 'date'],
            'indication' => ['nullable', 'string'],
            'procedure_details' => ['nullable', 'string'],
            'outcome' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
