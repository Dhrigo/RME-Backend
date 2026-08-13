<?php

namespace Modules\InventoryItemPrice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'effective_date' => ['required', 'date'],
        ];
    }
}
