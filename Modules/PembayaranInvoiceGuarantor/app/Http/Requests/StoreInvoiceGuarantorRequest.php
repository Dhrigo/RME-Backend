<?php

namespace Modules\PembayaranInvoiceGuarantor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;

class StoreInvoiceGuarantorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'guarantor_id' => ['required', 'integer', 'exists:guarantors,id'],
            'covered_amount' => ['sometimes', 'numeric', 'min:0'],
            'coverage_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'verification_status' => ['sometimes', Rule::in(InvoiceGuarantor::VERIFICATION_STATUSES)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
