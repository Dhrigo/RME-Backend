<?php

namespace Modules\InventoryStockOpnameItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockOpnameItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stock_opname_id' => ['required', 'integer', 'exists:stock_opnames,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'system_quantity' => ['required', 'integer', 'min:0'],
            'physical_quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
