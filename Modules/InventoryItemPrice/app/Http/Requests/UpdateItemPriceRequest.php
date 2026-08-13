<?php

namespace Modules\InventoryItemPrice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_active' => ['required', 'boolean'],
        ];
    }
}
