<?php

namespace Modules\PembayaranInvoiceItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['sometimes', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'quantity' => ['sometimes', 'integer', 'min:1'],
            'unit_price' => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}
