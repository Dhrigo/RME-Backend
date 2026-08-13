<?php

namespace Modules\PembayaranClaimInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaimInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'claim_number' => ['nullable', 'string', 'max:255', 'unique:claim_invoices,claim_number'],
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'guarantor_id' => ['nullable', 'integer', 'exists:guarantors,id'],
            'claim_amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
