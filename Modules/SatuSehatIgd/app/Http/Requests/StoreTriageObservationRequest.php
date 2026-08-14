<?php

namespace Modules\SatuSehatIgd\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTriageObservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'string'],
            'patient_name' => ['required', 'string'],
            'encounter_id' => ['required', 'string'],
            'practitioner_id' => ['required', 'string'],
            'effective_date_time' => ['required', 'date'],
            'triage_loinc_code' => ['required', 'string'],
            'triage_level_display' => ['required', 'string'],
        ];
    }
}
