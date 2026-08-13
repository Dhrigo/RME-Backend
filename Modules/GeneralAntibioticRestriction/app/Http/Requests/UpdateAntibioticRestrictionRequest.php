<?php

namespace Modules\GeneralAntibioticRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction;

class UpdateAntibioticRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'aware_category' => ['sometimes', 'string', Rule::in(AntibioticRestriction::AWARE_CATEGORIES)],
            'requires_pra_approval' => ['sometimes', 'boolean'],
            'restriction_condition' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
