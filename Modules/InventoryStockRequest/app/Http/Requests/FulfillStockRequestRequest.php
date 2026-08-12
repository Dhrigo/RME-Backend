<?php

namespace Modules\InventoryStockRequest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FulfillStockRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:fulfilled,rejected'],
        ];
    }
}
