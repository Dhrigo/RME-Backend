<?php

namespace Modules\MedicalRecordEndOfLifePsychosocialRelationship\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEndOfLifePsychosocialRelationshipRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'relationship_type' => ['nullable', 'string', 'max:100'],
            'support_system' => ['nullable', 'string'],
            'spiritual_needs' => ['nullable', 'string'],
            'emotional_state' => ['nullable', 'string', 'max:100'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'assessed_at' => ['required', 'date'],
        ];
    }
}
