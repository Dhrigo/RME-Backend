<?php

namespace Modules\GeneralPrescriptionFrequencyRuleCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionFrequencyRuleCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_frequency_rule_id' => ['sometimes', 'integer', 'exists:prescription_frequency_rules,id'],
            'category_name' => ['sometimes', 'string', 'max:255'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
