<?php

namespace Modules\LayananLabCultureResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLabCultureResultRequest extends FormRequest
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
            'organism_found' => ['nullable', 'string', 'max:255'],
            'colony_count' => ['nullable', 'string', 'max:255'],
            'examined_at' => ['required', 'date'],
            'result_status' => ['required', Rule::in(['pending', 'positive', 'negative'])],
        ];
    }
}
