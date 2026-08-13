<?php

namespace Modules\LayananRadiologyResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRadiologyResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'radiology_order_id' => ['required', 'integer', 'exists:radiology_orders,id'],
            'findings' => ['required', 'string'],
            'impression' => ['nullable', 'string'],
            'radiologist_id' => ['nullable', 'integer', 'exists:employees,id'],
            'examined_at' => ['required', 'date'],
            'status' => ['required', Rule::in(['pending', 'final'])],
        ];
    }
}
