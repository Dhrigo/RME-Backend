<?php

namespace Modules\MedicalRecordPhysicalExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhysicalExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'general_condition' => 'nullable|string|max:100',
            'consciousness_gcs' => 'nullable|string|max:100',
            'head_to_toe_notes' => 'nullable|string',
            'examined_by' => 'nullable|integer',
            'examined_at' => 'nullable|date',
        ];
    }
}
