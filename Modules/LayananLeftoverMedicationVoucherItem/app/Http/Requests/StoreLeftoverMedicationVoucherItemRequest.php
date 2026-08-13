<?php

namespace Modules\LayananLeftoverMedicationVoucherItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeftoverMedicationVoucherItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'leftover_medication_voucher_id' => ['required', 'integer', 'exists:leftover_medication_vouchers,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer'],
            'unit' => ['nullable', 'string', 'max:255'],
        ];
    }
}
