<?php

namespace Modules\PembayaranEdc\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranEdc\Models\Edc;

class StoreEdcRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_id' => ['required', 'integer', 'exists:payments,id'],
            'edc_reference_number' => ['required', 'string', 'max:255', 'unique:edc_transactions,edc_reference_number'],
            'bank_name' => ['required', 'string', 'max:255'],
            'card_type' => ['required', Rule::in(Edc::CARD_TYPES)],
            'card_last_four' => ['nullable', 'string', 'size:4'],
            'approval_code' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'transaction_at' => ['nullable', 'date'],
        ];
    }
}
