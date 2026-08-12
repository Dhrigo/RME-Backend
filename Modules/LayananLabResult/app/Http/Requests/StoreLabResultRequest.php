<?php

namespace Modules\LayananLabResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'test_name' => ['required', 'string', 'max:255'],
            'result_value' => ['required', 'string', 'max:255'],
            'normal_range' => ['nullable', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:255'],
            'is_abnormal' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
            'recorded_at' => ['nullable', 'date'],
        ];
    }
}
