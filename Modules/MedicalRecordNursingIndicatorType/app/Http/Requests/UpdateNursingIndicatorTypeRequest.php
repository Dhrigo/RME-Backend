<?php

namespace Modules\MedicalRecordNursingIndicatorType\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNursingIndicatorTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
