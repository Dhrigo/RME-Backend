<?php

namespace Modules\MedicalRecordRehabilitationProcedureExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRehabilitationProcedureExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'procedure_name' => 'required|string|max:150',
            'therapist_id' => 'nullable|integer',
            'diagnosis_summary' => 'nullable|string',
            'functional_goal' => 'nullable|string',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
