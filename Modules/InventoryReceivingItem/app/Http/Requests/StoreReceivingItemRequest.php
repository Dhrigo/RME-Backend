<?php

namespace Modules\InventoryReceivingItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceivingItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'receiving_record_id' => ['required', 'integer', 'exists:receiving_records,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
