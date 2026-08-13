<?php

namespace Modules\PembayaranInvoiceCancellation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceCancellationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'reason' => ['required', 'string'],
        ];
    }
}
