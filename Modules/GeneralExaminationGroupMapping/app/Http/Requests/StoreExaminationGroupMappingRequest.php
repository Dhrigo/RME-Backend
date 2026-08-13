<?php

namespace Modules\GeneralExaminationGroupMapping\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationGroupMappingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'examination_group_id' => ['required', 'integer', 'exists:examination_groups,id'],
            'mapping_category' => ['required', 'string', 'max:255'],
            'external_code' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
