<?php

namespace Modules\GeneralExaminationGroupMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExaminationGroupMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mapping_category' => ['sometimes', 'string', 'max:255'],
            'external_code' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
