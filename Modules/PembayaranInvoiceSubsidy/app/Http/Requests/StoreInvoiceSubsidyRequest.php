<?php

namespace Modules\PembayaranInvoiceSubsidy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;

class StoreInvoiceSubsidyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'subsidy_source' => ['required', Rule::in(InvoiceSubsidy::SUBSIDY_SOURCES)],
            'subsidy_amount' => ['required', 'numeric', 'min:0'],
            'status' => ['sometimes', Rule::in(InvoiceSubsidy::STATUSES)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
