<?php

namespace Modules\LayananLabSensitivityResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLabSensitivityResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'organism' => ['required', 'string', 'max:255'],
            'antibiotic_name' => ['required', 'string', 'max:255'],
            'sensitivity_result' => ['required', Rule::in(['sensitive', 'intermediate', 'resistant'])],
            'examined_at' => ['required', 'date'],
        ];
    }
}
