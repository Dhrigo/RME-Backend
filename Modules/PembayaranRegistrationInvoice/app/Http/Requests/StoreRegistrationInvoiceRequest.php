<?php

namespace Modules\PembayaranRegistrationInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranRegistrationInvoice\Models\RegistrationInvoice;

class StoreRegistrationInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_id' => ['required', 'integer', 'exists:registrations,id'],
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'invoice_category' => ['sometimes', Rule::in(RegistrationInvoice::CATEGORIES)],
            'amount' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
