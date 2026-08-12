<?php

namespace Modules\GeneralEmployee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('employee')?->id;

        return [
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'employee_number' => ['nullable', 'string', 'max:255', Rule::unique('employees', 'employee_number')->ignore($id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'nickname' => ['nullable', 'string', 'max:255'],
            'title_prefix' => ['nullable', 'string', 'max:255'],
            'title_suffix' => ['nullable', 'string', 'max:255'],
            'birth_place' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'religion_id' => ['nullable', 'integer'],
            'gender_id' => ['nullable', 'integer'],
            'profession_id' => ['nullable', 'integer'],
            'smf_id' => ['nullable', 'integer'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:5'],
            'rw' => ['nullable', 'string', 'max:5'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'region_code' => ['nullable', 'string', 'max:255'],
            'is_non_employee' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
