<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicalNoteCoManagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clinical_note_id' => ['sometimes', 'integer', 'exists:clinical_notes,id'],
            'medical_department_id' => ['sometimes', 'integer', 'exists:medical_departments,id'],
            'notes' => ['nullable', 'string'],
            'author_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}
