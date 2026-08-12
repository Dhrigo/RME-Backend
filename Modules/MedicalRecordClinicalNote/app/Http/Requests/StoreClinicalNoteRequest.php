<?php

namespace Modules\MedicalRecordClinicalNote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicalNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'recorded_at' => ['nullable', 'date'],
            'subjective' => ['nullable', 'string'],
            'objective' => ['nullable', 'string'],
            'assessment' => ['nullable', 'string'],
            'planning' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'note_type' => ['nullable', 'string', 'max:255'],
            'author_id' => ['required', 'integer', 'exists:employees,id'],
            'sub_division' => ['nullable', 'string', 'max:255'],
            'has_discharge_plan' => ['sometimes', 'boolean'],
            'discharge_plan_date' => ['nullable', 'date'],
        ];
    }
}
