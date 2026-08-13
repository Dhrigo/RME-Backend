<?php

namespace Modules\PembayaranPackageInvoiceItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageInvoiceItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'package_id' => ['required', 'integer', 'exists:packages,id'],
            'quantity' => ['sometimes', 'integer', 'min:1'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
