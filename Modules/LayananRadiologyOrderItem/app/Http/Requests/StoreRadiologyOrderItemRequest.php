<?php

namespace Modules\LayananRadiologyOrderItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'radiology_order_id' => ['required', 'integer', 'exists:radiology_orders,id'],
            'examination_name' => ['required', 'string', 'max:255'],
            'body_part' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric'],
        ];
    }
}
