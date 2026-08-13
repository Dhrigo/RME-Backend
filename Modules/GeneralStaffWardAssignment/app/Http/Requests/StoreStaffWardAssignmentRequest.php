<?php

namespace Modules\GeneralStaffWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'staff_member_id' => ['required', 'exists:staff_members,id'],
            'ward_id' => ['required', 'exists:wards,id'],
            'assigned_at' => ['nullable', 'date'],
        ];
    }
}
