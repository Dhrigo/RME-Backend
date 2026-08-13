<?php

namespace Modules\MedicalRecordEmgExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmgExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'patient_id' => 'sometimes|required|integer',
            'nerve_conduction_velocity' => 'nullable|numeric',
            'spontaneous_activity' => 'nullable|string|max:100',
            'motor_unit_potentials' => 'nullable|string|max:100',
            'recruitment_pattern' => 'nullable|string|max:100',
            'conclusion' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
