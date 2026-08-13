<?php

namespace Modules\PembayaranPatientReceivableSettlement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientReceivableSettlementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_receivable_id' => ['required', 'integer', 'exists:patient_receivables,id'],
            'paid_amount' => ['required', 'numeric', 'min:0'],
            'paid_at' => ['nullable', 'date'],
        ];
    }
}
