<?php

namespace Modules\InventoryStockRequest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'requested_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
