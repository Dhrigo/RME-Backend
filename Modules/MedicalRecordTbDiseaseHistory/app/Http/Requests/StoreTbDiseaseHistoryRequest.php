<?php

namespace Modules\MedicalRecordTbDiseaseHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTbDiseaseHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'previous_tb_treatment' => ['nullable','boolean'],
            'treatment_year' => ['nullable','integer','min:1900'],
            'treatment_outcome' => ['nullable','in:cured,completed,failed,ongoing'],
            'tb_category' => ['nullable','string','max:255'],
            'notes' => ['nullable','string'],
        ];
    }
}
