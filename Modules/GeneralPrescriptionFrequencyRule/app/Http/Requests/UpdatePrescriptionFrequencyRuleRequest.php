<?php

namespace Modules\GeneralPrescriptionFrequencyRule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePrescriptionFrequencyRuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['sometimes', 'string', 'max:255', Rule::unique('prescription_frequency_rules', 'code')->ignore($this->route('prescription_frequency_rule'))],
            'description' => ['nullable', 'string', 'max:255'],
            'times_per_day' => ['sometimes', 'integer', 'min:1', 'max:24'],
            'interval_hours' => ['nullable', 'integer', 'min:1', 'max:24'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
