<?php

namespace Modules\MedicalRecordNeckExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNeckExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'lymph_nodes' => 'nullable|string|max:150',
            'thyroid' => 'nullable|string|max:150',
            'jugular_venous_pressure' => 'nullable|string|max:50',
            'trachea_position' => 'nullable|string|max:50',
            'mass' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
