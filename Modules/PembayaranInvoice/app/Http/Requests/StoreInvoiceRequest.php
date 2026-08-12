<?php

namespace Modules\PembayaranInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_number' => ['nullable', 'string', 'max:255', 'unique:invoices,invoice_number'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'invoice_date' => ['nullable', 'date'],
            'rounding_adjustment' => ['sometimes', 'numeric'],
        ];
    }
}
