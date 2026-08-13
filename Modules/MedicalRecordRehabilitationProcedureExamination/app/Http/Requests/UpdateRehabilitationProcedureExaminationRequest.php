<?php

namespace Modules\MedicalRecordRehabilitationProcedureExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRehabilitationProcedureExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'procedure_name' => 'sometimes|required|string|max:150',
            'therapist_id' => 'nullable|integer',
            'diagnosis_summary' => 'nullable|string',
            'functional_goal' => 'nullable|string',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
