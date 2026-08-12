<?php

namespace Modules\PembayaranPayment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_number' => ['nullable', 'string', 'max:255', 'unique:payments,payment_number'],
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'payment_method' => ['required', 'string', 'in:cash,debit,credit,transfer'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'admin_fee' => ['sometimes', 'numeric', 'min:0'],
            'paid_at' => ['nullable', 'date'],
        ];
    }
}
