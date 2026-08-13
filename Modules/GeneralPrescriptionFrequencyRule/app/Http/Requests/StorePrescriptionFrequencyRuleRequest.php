<?php

namespace Modules\GeneralPrescriptionFrequencyRule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionFrequencyRuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:prescription_frequency_rules,code'],
            'description' => ['nullable', 'string', 'max:255'],
            'times_per_day' => ['required', 'integer', 'min:1', 'max:24'],
            'interval_hours' => ['nullable', 'integer', 'min:1', 'max:24'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
