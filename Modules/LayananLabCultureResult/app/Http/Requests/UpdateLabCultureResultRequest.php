<?php

namespace Modules\LayananLabCultureResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLabCultureResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['sometimes', 'integer', 'exists:lab_orders,id'],
            'specimen_type' => ['sometimes', 'string', 'max:255'],
            'organism_found' => ['sometimes', 'string', 'max:255'],
            'colony_count' => ['sometimes', 'string', 'max:255'],
            'examined_at' => ['sometimes', 'date'],
            'result_status' => ['sometimes', Rule::in(['pending', 'positive', 'negative'])],
        ];
    }
}
