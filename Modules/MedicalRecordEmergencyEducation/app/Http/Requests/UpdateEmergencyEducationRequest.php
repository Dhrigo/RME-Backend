<?php

namespace Modules\MedicalRecordEmergencyEducation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmergencyEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'topic' => ['sometimes', 'string', 'max:150'],
            'method' => ['nullable', 'string', 'max:50'],
            'understanding_level' => ['nullable', 'string', 'max:50'],
            'educator_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'educated_at' => ['sometimes', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
