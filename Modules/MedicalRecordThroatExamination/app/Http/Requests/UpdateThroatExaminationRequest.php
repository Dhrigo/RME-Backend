<?php

namespace Modules\MedicalRecordThroatExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThroatExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'pharynx' => 'nullable|string|max:100',
            'uvula' => 'nullable|string|max:50',
            'mucosa' => 'nullable|string|max:100',
            'exudate' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
