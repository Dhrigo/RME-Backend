<?php

namespace Modules\LayananPharmacyServiceFee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyServiceFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'item_id' => ['sometimes', 'integer', 'exists:items,id'],
            'fee_name' => ['sometimes', 'string', 'max:255'],
            'amount' => ['sometimes', 'numeric'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
