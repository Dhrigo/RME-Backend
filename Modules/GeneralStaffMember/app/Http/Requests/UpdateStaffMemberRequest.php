<?php

namespace Modules\GeneralStaffMember\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'exists:employees,id'],
            'staff_role' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
