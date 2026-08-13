<?php

namespace Modules\GeneralPackageTariffDistributionItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralPackageTariffDistributionItem\Models\PackageTariffDistributionItem;

class StorePackageTariffDistributionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_tariff_distribution_id' => ['required', 'integer', 'exists:package_tariff_distributions,id'],
            'recipient_type' => ['required', Rule::in(PackageTariffDistributionItem::RECIPIENT_TYPES)],
            'recipient_id' => ['nullable', 'integer'],
            'percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'amount' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
