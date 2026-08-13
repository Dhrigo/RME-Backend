<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuarantorItemCategoryMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_covered' => ['sometimes', 'boolean'],
            'coverage_percentage' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
