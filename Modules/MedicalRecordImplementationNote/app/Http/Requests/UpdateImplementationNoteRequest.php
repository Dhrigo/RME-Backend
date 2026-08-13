<?php

namespace Modules\MedicalRecordImplementationNote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImplementationNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'note_type' => ['nullable', 'string', 'max:100'],
            'content' => ['nullable', 'string'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}
