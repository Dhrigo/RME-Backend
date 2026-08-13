<?php

namespace Modules\MedicalRecordNursingIndicatorType\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingIndicatorTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
