<?php

namespace Modules\PembayaranInvoiceSubsidy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;

class UpdateInvoiceSubsidyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subsidy_source' => ['sometimes', Rule::in(InvoiceSubsidy::SUBSIDY_SOURCES)],
            'subsidy_amount' => ['sometimes', 'numeric', 'min:0'],
            'status' => ['sometimes', Rule::in(InvoiceSubsidy::STATUSES)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
