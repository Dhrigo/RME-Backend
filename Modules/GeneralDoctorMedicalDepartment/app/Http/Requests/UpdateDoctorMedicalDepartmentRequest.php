<?php

namespace Modules\GeneralDoctorMedicalDepartment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorMedicalDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => ['sometimes', 'exists:doctors,id'],
            'medical_department_id' => ['sometimes', 'exists:medical_departments,id'],
            'is_head' => ['nullable', 'boolean'],
        ];
    }
}
