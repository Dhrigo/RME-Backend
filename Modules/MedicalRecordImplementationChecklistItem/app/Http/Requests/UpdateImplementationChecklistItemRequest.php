<?php

namespace Modules\MedicalRecordImplementationChecklistItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImplementationChecklistItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:30'],
            'name' => ['sometimes', 'string', 'max:150'],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
