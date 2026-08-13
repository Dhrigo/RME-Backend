<?php

namespace Modules\PenjualanSaleReturn\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_id' => ['required', 'integer', 'exists:sales,id'],
            'returned_at' => ['nullable', 'date'],
            'reason' => ['nullable', 'string'],
            'refund_amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
