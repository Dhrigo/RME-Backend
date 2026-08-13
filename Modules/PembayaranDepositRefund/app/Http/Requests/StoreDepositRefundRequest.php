<?php

namespace Modules\PembayaranDepositRefund\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepositRefundRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deposit_id' => ['required', 'integer', 'exists:deposits,id'],
            'refunded_amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
