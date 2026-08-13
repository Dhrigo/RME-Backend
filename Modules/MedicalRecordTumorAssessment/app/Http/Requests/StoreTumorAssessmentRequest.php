<?php

namespace Modules\MedicalRecordTumorAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTumorAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_id' => ['nullable', 'integer', 'exists:diagnoses,id'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'tumor_location' => ['required','string','max:255'],
            'size_cm' => ['nullable','numeric','min:0'],
            'tnm_t' => ['nullable','string','max:10'],
            'tnm_n' => ['nullable','string','max:10'],
            'tnm_m' => ['nullable','string','max:10'],
            'grade' => ['nullable','string','max:10'],
            'notes' => ['nullable','string'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
