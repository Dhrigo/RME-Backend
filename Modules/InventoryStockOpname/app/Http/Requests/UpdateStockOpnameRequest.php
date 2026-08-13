<?php

namespace Modules\InventoryStockOpname\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStockOpnameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', Rule::in(['in_progress', 'completed', 'cancelled'])],
            'notes' => ['nullable', 'string'],
        ];
    }
}
