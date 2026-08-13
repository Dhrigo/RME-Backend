<?php

namespace Modules\GeneralNurse\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNurseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'exists:employees,id'],
            'nurse_license_number' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
