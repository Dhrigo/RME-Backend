<?php

namespace Modules\MedicalRecordGeneralExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'general_appearance' => 'nullable|string|max:150',
            'consciousness_level' => 'nullable|string|max:50',
            'nutritional_status' => 'nullable|string|max:50',
            'posture' => 'nullable|string|max:50',
            'gait' => 'nullable|string|max:50',
            'examined_at' => 'nullable|date',
        ];
    }
}
