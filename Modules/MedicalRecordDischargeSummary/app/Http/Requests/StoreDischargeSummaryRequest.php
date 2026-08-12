<?php

namespace Modules\MedicalRecordDischargeSummary\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDischargeSummaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'admission_diagnosis_id' => ['nullable', 'integer', 'exists:diagnoses,id'],
            'discharge_diagnosis_id' => ['nullable', 'integer', 'exists:diagnoses,id'],
            'treatment_summary' => ['nullable', 'string'],
            'condition_at_discharge' => ['nullable', 'string'],
            'follow_up_plan' => ['nullable', 'string'],
            'discharge_medication' => ['nullable', 'string'],
            'authored_by' => ['required', 'integer', 'exists:employees,id'],
            'authored_at' => ['nullable', 'date'],
        ];
    }
}
