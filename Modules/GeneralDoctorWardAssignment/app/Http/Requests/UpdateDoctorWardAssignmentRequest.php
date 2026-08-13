<?php

namespace Modules\GeneralDoctorWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => ['sometimes', 'exists:doctors,id'],
            'ward_id' => ['sometimes', 'exists:wards,id'],
            'assigned_at' => ['nullable', 'date'],
            'schedule_day' => ['nullable', 'string', 'max:50'],
        ];
    }
}
