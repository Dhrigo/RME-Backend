<?php

namespace Modules\LayananLabOrderItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'examination_name' => ['required', 'string', 'max:255'],
            'item_id' => ['nullable', 'integer', 'exists:items,id'],
            'price' => ['nullable', 'numeric'],
        ];
    }
}
