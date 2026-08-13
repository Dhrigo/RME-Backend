<?php

namespace Modules\InventoryWardStockTransaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWardStockTransactionRequest extends FormRequest
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
            'type' => ['required', 'string', Rule::in(['in', 'out'])],
            'quantity' => ['required', 'integer', 'min:1'],
            'performed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
