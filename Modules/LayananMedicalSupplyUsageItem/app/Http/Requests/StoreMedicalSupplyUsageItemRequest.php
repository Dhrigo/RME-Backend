<?php

namespace Modules\LayananMedicalSupplyUsageItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalSupplyUsageItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_supply_usage_id' => ['required', 'integer', 'exists:medical_supply_usages,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer'],
            'unit' => ['nullable', 'string', 'max:255'],
        ];
    }
}
