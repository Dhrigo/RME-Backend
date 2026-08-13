<?php

namespace Modules\LayananLabExaminationResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabExaminationResultRequest extends FormRequest
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
            'result_value' => ['required', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:255'],
            'reference_range' => ['nullable', 'string', 'max:255'],
            'is_abnormal' => ['sometimes', 'boolean'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
