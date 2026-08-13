<?php

namespace Modules\LayananPrescriptionFulfillmentItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionFulfillmentItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_fulfillment_id' => ['sometimes', 'integer', 'exists:prescription_fulfillments,id'],
            'prescription_item_id' => ['sometimes', 'integer', 'exists:prescription_items,id'],
            'quantity_served' => ['sometimes', 'integer'],
            'is_substituted' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
