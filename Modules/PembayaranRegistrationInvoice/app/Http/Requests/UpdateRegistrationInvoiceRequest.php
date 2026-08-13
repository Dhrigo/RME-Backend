<?php

namespace Modules\PembayaranRegistrationInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranRegistrationInvoice\Models\RegistrationInvoice;

class UpdateRegistrationInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_category' => ['sometimes', Rule::in(RegistrationInvoice::CATEGORIES)],
            'amount' => ['sometimes', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
