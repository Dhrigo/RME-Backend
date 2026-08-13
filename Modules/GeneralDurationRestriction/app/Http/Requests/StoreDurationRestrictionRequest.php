<?php

namespace Modules\GeneralDurationRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDurationRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antibiotic_name' => ['required', 'string', 'max:255', 'unique:duration_restrictions,antibiotic_name'],
            'max_days' => ['required', 'integer', 'min:1', 'max:90'],
            'min_days' => ['nullable', 'integer', 'min:1', 'lte:max_days'],
            'requires_reevaluation' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
