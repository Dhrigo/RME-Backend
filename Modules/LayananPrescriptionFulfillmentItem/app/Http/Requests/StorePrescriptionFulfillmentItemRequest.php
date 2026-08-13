<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionFulfillmentItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_fulfillment_id' => ['required', 'integer', 'exists:prescription_fulfillments,id'],
            'prescription_item_id' => ['required', 'integer', 'exists:prescription_items,id'],
            'quantity_served' => ['required', 'integer'],
            'is_substituted' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
