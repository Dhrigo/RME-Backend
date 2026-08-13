<?php

namespace Modules\GeneralMedicalDepartmentWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalDepartmentWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_primary' => ['sometimes', 'boolean'],
            'assigned_at' => ['nullable', 'date'],
        ];
    }
}
