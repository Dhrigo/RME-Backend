<?php

namespace Modules\GeneralReferenceMap\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferenceMapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'source_system' => ['required', 'string', 'max:255'],
            'source_code' => ['required', 'string', 'max:255'],
            'target_category' => ['required', 'string', 'max:255'],
            'target_code' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
