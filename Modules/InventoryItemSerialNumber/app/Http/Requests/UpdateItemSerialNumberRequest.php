<?php

namespace Modules\InventoryItemSerialNumber\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemSerialNumberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'serial_number' => ['sometimes', 'string', 'max:255', Rule::unique('item_serial_numbers', 'serial_number')->ignore($this->route('inventoryitemserialnumber'))],
            'expiry_date' => ['nullable', 'date'],
        ];
    }
}
