<?php

namespace Modules\GeneralAdmissionDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmissionDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_code_id' => ['required', 'integer', 'exists:diagnosis_codes,id'],
            'diagnosis_text' => ['nullable', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
            'diagnosed_at' => ['nullable', 'date'],
        ];
    }
}
