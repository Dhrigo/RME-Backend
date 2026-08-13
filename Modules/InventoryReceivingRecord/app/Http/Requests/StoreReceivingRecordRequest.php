<?php

namespace Modules\InventoryReceivingRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceivingRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'received_by' => ['required', 'integer', 'exists:employees,id'],
            'received_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
