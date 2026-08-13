<?php

namespace Modules\GeneralDiagnosisRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiagnosisRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'requires_justification' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
