<?php

namespace Modules\GeneralQuantityRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuantityRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'max_quantity_per_prescription' => ['sometimes', 'integer', 'min:1'],
            'unit' => ['sometimes', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
