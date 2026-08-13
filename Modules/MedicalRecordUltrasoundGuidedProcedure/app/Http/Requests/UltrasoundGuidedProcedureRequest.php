<?php

namespace Modules\MedicalRecordUltrasoundGuidedProcedure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UltrasoundGuidedProcedureRequest extends FormRequest
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
            'procedure_name' => ['required', 'string', 'max:255'],
            'target_site' => ['nullable', 'string', 'max:255'],
            'needle_gauge' => ['nullable', 'string', 'max:50'],
            'findings_and_outcome' => ['nullable', 'string'],
            'complications' => ['nullable', 'string'],
            'performed_at' => ['required', 'date'],
        ];
    }
}
