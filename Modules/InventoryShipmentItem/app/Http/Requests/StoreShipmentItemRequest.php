<?php

namespace Modules\InventoryShipmentItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipment_id' => ['required', 'integer', 'exists:shipments,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
