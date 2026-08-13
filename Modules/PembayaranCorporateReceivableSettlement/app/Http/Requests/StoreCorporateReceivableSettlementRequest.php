<?php

namespace Modules\PembayaranCorporateReceivableSettlement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCorporateReceivableSettlementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'corporate_receivable_id' => ['required', 'integer', 'exists:corporate_receivables,id'],
            'paid_amount' => ['required', 'numeric', 'min:0'],
            'paid_at' => ['nullable', 'date'],
        ];
    }
}
