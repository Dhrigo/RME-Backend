<?php

namespace Modules\MedicalRecordIllnessProgressionHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIllnessProgressionHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'symptom_onset_date' => ['nullable','date'],
            'progression_description' => ['required','string'],
            'prior_treatment' => ['nullable','string'],
        ];
    }
}
