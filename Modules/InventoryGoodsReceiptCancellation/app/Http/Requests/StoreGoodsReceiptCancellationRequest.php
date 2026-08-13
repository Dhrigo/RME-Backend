<?php

namespace Modules\InventoryGoodsReceiptCancellation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoodsReceiptCancellationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'goods_receipt_id' => ['required', 'integer', 'exists:goods_receipts,id'],
            'reason' => ['required', 'string'],
            'cancelled_at' => ['nullable', 'date'],
        ];
    }
}
