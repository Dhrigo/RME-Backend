<?php

namespace Modules\MedicalRecordPediatricStatus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PediatricStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'birth_weight_grams' => ['nullable', 'integer', 'min:0'],
            'birth_length_cm' => ['nullable', 'numeric', 'min:0'],
            'head_circumference_cm' => ['nullable', 'numeric', 'min:0'],
            'gestational_age_weeks' => ['nullable', 'integer', 'min:0', 'max:50'],
            'immunization_status' => ['nullable', 'string', 'max:255'],
            'developmental_milestones' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'recorded_at' => ['nullable', 'date'],
        ];
    }
}
