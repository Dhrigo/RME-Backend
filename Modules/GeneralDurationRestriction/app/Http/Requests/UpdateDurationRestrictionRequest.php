<?php

namespace Modules\GeneralDurationRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDurationRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'max_days' => ['sometimes', 'integer', 'min:1', 'max:90'],
            'min_days' => ['nullable', 'integer', 'min:1', 'lte:max_days'],
            'requires_reevaluation' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
