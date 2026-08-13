<?php

namespace Modules\PembayaranInvoiceMerge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceMergeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'merge_number' => ['nullable', 'string', 'max:255'],
            'payment_id' => ['required', 'integer', 'exists:payments,id'],
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'allocated_amount' => ['required', 'numeric', 'min:0'],
            'merged_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
