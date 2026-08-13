<?php

namespace Modules\GeneralReferenceMap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReferenceMapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'source_system' => ['sometimes', 'string', 'max:255'],
            'source_code' => ['sometimes', 'string', 'max:255'],
            'target_category' => ['sometimes', 'string', 'max:255'],
            'target_code' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
