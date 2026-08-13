<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuarantorItemCategoryMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guarantor_id' => ['required', 'integer', 'exists:guarantors,id'],
            'item_category_id' => ['required', 'integer', 'exists:item_categories,id'],
            'is_covered' => ['sometimes', 'boolean'],
            'coverage_percentage' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
