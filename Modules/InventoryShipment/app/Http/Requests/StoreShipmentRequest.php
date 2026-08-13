<?php

namespace Modules\InventoryShipment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_ward_id' => ['required', 'integer', 'exists:wards,id', 'different:to_ward_id'],
            'to_ward_id' => ['required', 'integer', 'exists:wards,id'],
            'shipped_by' => ['required', 'integer', 'exists:employees,id'],
            'shipped_at' => ['nullable', 'date'],
        ];
    }
}
