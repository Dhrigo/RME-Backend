<?php

namespace Modules\LayananLabPcrResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLabPcrResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'target_gene' => ['required', 'string', 'max:255'],
            'result' => ['required', Rule::in(['detected', 'not_detected', 'inconclusive'])],
            'ct_value' => ['nullable', 'numeric'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
