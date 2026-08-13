<?php

namespace Modules\MedicalRecordAnamnesis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnamnesisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'present_illness_history' => ['nullable', 'string'],
            'past_medical_history' => ['nullable', 'string'],
            'family_medical_history' => ['nullable', 'string'],
            'allergy_history' => ['nullable', 'string'],
            'social_history' => ['nullable', 'string'],
            'recorded_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recorded_at' => ['sometimes', 'date'],
        ];
    }
}
