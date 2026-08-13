<?php

namespace Modules\GeneralAntibioticRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction;

class StoreAntibioticRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antibiotic_name' => ['required', 'string', 'max:255', 'unique:antibiotic_restrictions,antibiotic_name'],
            'aware_category' => ['required', 'string', Rule::in(AntibioticRestriction::AWARE_CATEGORIES)],
            'requires_pra_approval' => ['sometimes', 'boolean'],
            'restriction_condition' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
