<?php

namespace Modules\GeneralFormularyRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralFormularyRestriction\Models\FormularyRestriction;

class StoreFormularyRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'drug_name' => ['required', 'string', 'max:255', 'unique:formulary_restrictions,drug_name'],
            'formulary_category' => ['required', 'string', Rule::in(FormularyRestriction::FORMULARY_CATEGORIES)],
            'requires_substitution' => ['sometimes', 'boolean'],
            'substitution_drug_name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
