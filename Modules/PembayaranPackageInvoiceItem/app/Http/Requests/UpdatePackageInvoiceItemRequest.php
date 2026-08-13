<?php

namespace Modules\PembayaranPackageInvoiceItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageInvoiceItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['sometimes', 'integer', 'min:1'],
            'unit_price' => ['sometimes', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
