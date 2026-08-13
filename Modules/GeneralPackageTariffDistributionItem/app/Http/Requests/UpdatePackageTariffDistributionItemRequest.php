<?php

namespace Modules\GeneralPackageTariffDistributionItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\GeneralPackageTariffDistributionItem\Models\PackageTariffDistributionItem;

class UpdatePackageTariffDistributionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'recipient_type' => ['sometimes', Rule::in(PackageTariffDistributionItem::RECIPIENT_TYPES)],
            'recipient_id' => ['nullable', 'integer'],
            'percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
