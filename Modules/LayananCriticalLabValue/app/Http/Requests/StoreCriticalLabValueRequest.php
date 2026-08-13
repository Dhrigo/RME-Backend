<?php

namespace Modules\LayananCriticalLabValue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCriticalLabValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'parameter_name' => ['required', 'string', 'max:255'],
            'critical_value' => ['required', 'string', 'max:255'],
            'notified_to' => ['nullable', 'string', 'max:255'],
            'notified_at' => ['nullable', 'date'],
            'acknowledged' => ['sometimes', 'boolean'],
        ];
    }
}
