<?php

namespace Modules\LayananLabOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_number' => ['nullable', 'string', 'max:255', 'unique:lab_orders,order_number'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'ordered_by' => ['required', 'integer', 'exists:employees,id'],
            'ordered_at' => ['nullable', 'date'],
            'destination' => ['nullable', 'string', 'max:255'],
            'is_emergency' => ['sometimes', 'boolean'],
            'reason' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
