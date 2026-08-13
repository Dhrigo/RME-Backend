<?php

namespace Modules\GeneralQuantityRestriction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuantityRestrictionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'drug_name' => ['required', 'string', 'max:255', 'unique:quantity_restrictions,drug_name'],
            'max_quantity_per_prescription' => ['required', 'integer', 'min:1'],
            'unit' => ['required', 'string', 'max:50'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
