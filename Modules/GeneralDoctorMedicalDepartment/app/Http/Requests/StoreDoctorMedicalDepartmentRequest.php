<?php

namespace Modules\GeneralDoctorMedicalDepartment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorMedicalDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => ['required', 'exists:doctors,id'],
            'medical_department_id' => ['required', 'exists:medical_departments,id'],
            'is_head' => ['nullable', 'boolean'],
        ];
    }
}
