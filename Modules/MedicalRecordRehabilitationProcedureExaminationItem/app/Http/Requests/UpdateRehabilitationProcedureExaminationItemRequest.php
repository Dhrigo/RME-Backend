<?php

namespace Modules\MedicalRecordRehabilitationProcedureExaminationItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRehabilitationProcedureExaminationItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rehabilitation_procedure_examination_id' => 'sometimes|required|integer',
            'step_name' => 'sometimes|required|string|max:150',
            'duration_minutes' => 'nullable|integer|min:0',
            'result' => 'nullable|string|max:100',
            'sequence' => 'nullable|integer|min:1',
        ];
    }
}
