<?php

namespace Modules\MedicalRecordIcd10CauseOfDeathCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIcd10CauseOfDeathCodeRequest extends FormRequest
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
            'category' => ['nullable', 'string', 'max:50'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
