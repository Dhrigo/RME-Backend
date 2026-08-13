<?php

namespace Modules\LayananPharmacyReturn\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_item_id' => ['required', 'integer', 'exists:prescription_items,id'],
            'quantity_returned' => ['required', 'integer'],
            'reason' => ['required', 'string', 'max:255'],
            'returned_by' => ['required', 'integer', 'exists:employees,id'],
            'returned_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
