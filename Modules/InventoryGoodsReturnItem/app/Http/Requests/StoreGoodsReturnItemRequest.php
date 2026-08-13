<?php

namespace Modules\InventoryGoodsReturnItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsReturnItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'goods_return_id' => ['required', 'integer', 'exists:goods_returns,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['nullable', 'numeric', 'min:0'],
            'reason' => ['nullable', 'string', 'max:255'],
        ];
    }
}
