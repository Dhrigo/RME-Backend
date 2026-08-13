<?php

namespace Modules\GeneralAdmissionDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdmissionDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diagnosis_code_id' => ['sometimes', 'integer', 'exists:diagnosis_codes,id'],
            'diagnosis_text' => ['nullable', 'string', 'max:255'],
            'is_primary' => ['sometimes', 'boolean'],
        ];
    }
}
