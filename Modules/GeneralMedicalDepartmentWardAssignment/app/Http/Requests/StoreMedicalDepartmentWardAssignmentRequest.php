<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalDepartmentWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medical_department_id' => ['required', 'integer', 'exists:medical_departments,id'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'is_primary' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
            'assigned_at' => ['nullable', 'date'],
        ];
    }
}
