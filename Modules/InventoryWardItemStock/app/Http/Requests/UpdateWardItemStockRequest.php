<?php

namespace Modules\InventoryWardItemStock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWardItemStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
