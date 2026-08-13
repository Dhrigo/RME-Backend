<?php

namespace Modules\InventoryMinimumStockLevel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMinimumStockLevelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => ['sometimes', 'integer', 'exists:items,id'],
            'ward_id' => ['nullable', 'integer', 'exists:wards,id'],
            'minimum_quantity' => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
