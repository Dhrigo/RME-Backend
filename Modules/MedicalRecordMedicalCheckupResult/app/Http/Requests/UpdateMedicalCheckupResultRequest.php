<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalCheckupResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'checkup_date' => ['sometimes', 'date'],
            'category' => ['nullable', 'string', 'max:100'],
            'summary' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'examined_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
