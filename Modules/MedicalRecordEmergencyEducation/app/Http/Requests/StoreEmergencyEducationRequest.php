<?php

namespace Modules\MedicalRecordEmergencyEducation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmergencyEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'topic' => ['required', 'string', 'max:150'],
            'method' => ['nullable', 'string', 'max:50'],
            'understanding_level' => ['nullable', 'string', 'max:50'],
            'educator_id' => ['required', 'integer', 'exists:employees,id'],
            'educated_at' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
