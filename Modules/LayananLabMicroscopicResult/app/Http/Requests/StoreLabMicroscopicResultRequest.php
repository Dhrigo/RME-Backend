<?php

namespace Modules\LayananLabMicroscopicResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabMicroscopicResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'specimen_type' => ['required', 'string', 'max:255'],
            'findings' => ['required', 'string'],
            'examined_by' => ['nullable', 'integer', 'exists:employees,id'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
