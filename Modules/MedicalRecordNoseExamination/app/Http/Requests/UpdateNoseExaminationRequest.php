<?php

namespace Modules\MedicalRecordNoseExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoseExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'deformity' => 'nullable|string|max:100',
            'septum_deviation' => 'nullable|boolean',
            'turbinate_hypertrophy' => 'nullable|boolean',
            'nasal_discharge' => 'nullable|string|max:100',
            'polyp_present' => 'nullable|boolean',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
