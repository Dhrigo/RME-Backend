<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalCheckupResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'checkup_date' => ['required', 'date'],
            'category' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'examined_by' => ['required', 'integer', 'exists:employees,id'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
