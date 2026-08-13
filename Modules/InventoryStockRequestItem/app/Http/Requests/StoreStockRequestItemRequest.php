<?php

namespace Modules\InventoryStockRequestItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequestItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stock_request_id' => ['required', 'integer', 'exists:stock_requests,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
