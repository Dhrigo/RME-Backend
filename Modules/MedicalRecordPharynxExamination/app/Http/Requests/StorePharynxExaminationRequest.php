<?php

namespace Modules\MedicalRecordPharynxExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharynxExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'mucosa_color' => 'nullable|string|max:100',
            'exudate' => 'nullable|boolean',
            'post_nasal_drip' => 'nullable|boolean',
            'posterior_wall_condition' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
