<?php

namespace Modules\LayananCriticalLabValue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCriticalLabValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['sometimes', 'integer', 'exists:lab_orders,id'],
            'parameter_name' => ['sometimes', 'string', 'max:255'],
            'critical_value' => ['sometimes', 'string', 'max:255'],
            'notified_to' => ['sometimes', 'string', 'max:255'],
            'notified_at' => ['sometimes', 'date'],
            'acknowledged' => ['sometimes', 'boolean'],
        ];
    }
}
