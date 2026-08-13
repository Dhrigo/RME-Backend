<?php

namespace Modules\InventoryItemSerialNumber\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemSerialNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_item_stock_id' => ['required', 'integer', 'exists:ward_item_stocks,id'],
            'serial_number' => ['required', 'string', 'max:255', 'unique:item_serial_numbers,serial_number'],
            'expiry_date' => ['nullable', 'date'],
        ];
    }
}
