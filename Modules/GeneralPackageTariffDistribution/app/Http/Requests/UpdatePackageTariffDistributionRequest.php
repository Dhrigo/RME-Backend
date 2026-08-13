<?php

namespace Modules\GeneralPackageTariffDistribution\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;

class UpdatePackageTariffDistributionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'component_name' => ['sometimes', Rule::in(PackageTariffDistribution::COMPONENTS)],
            'percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
