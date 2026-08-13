<?php

namespace Modules\MedicalRecordFibroscanResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFibroscanResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'examination_date' => ['required', 'date'],
            'liver_stiffness_kpa' => ['nullable', 'numeric'],
            'cap_score' => ['nullable', 'numeric'],
            'fibrosis_stage' => ['nullable', 'string', 'max:20'],
            'examined_by' => ['required', 'integer', 'exists:employees,id'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
