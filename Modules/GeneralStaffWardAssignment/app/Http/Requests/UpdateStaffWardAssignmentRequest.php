<?php

namespace Modules\GeneralStaffWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'staff_member_id' => ['sometimes', 'exists:staff_members,id'],
            'ward_id' => ['sometimes', 'exists:wards,id'],
            'assigned_at' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
