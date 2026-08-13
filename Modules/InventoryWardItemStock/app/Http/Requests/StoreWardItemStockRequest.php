<?php

namespace Modules\InventoryWardItemStock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWardItemStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
