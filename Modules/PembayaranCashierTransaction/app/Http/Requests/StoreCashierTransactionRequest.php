<?php

namespace Modules\PembayaranCashierTransaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\PembayaranCashierTransaction\Models\CashierTransaction;

class StoreCashierTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cashier_id' => ['required', 'integer', 'exists:cashiers,id'],
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'transaction_type' => ['required', 'string', 'in:' . implode(',', CashierTransaction::TRANSACTION_TYPES)],
            'transacted_at' => ['nullable', 'date'],
        ];
    }
}
