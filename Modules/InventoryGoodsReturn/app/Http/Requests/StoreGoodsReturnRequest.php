<?php

namespace Modules\InventoryGoodsReturn\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'returned_at' => ['nullable', 'date'],
            'reason' => ['required', 'string'],
        ];
    }
}
