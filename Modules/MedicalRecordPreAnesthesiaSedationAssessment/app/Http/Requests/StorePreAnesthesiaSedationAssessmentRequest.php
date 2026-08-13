<?php

namespace Modules\MedicalRecordPreAnesthesiaSedationAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreAnesthesiaSedationAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'asa_classification' => ['required','in:I,II,III,IV,V,VI'],
            'mallampati_class' => ['nullable','integer','between:1,4'],
            'npo_hours' => ['nullable','integer','min:0','max:48'],
            'comorbidities' => ['nullable','string'],
            'planned_anesthesia_type' => ['nullable','string','max:255'],
            'risk_notes' => ['nullable','string'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
