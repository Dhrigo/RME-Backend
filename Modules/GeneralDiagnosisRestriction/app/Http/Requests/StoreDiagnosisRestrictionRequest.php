<?php

namespace Modules\GeneralDiagnosisRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosisRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'diagnosis_code_id' => ['required', 'integer', 'exists:diagnosis_codes,id'],
            'restricted_antibiotic_name' => ['required', 'string', 'max:255'],
            'requires_justification' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
