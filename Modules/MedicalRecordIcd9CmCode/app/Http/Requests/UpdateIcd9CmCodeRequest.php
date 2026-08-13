<?php

namespace Modules\MedicalRecordIcd9CmCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIcd9CmCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['sometimes', 'string', 'max:10'],
            'description' => ['sometimes', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
