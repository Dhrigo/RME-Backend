<?php

namespace Modules\MedicalRecordIcd9CmCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIcd9CmCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:10'],
            'description' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
