<?php

namespace Modules\MedicalRecordTreatmentHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentHistoryRequest extends FormRequest
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
            'treatment_description' => ['required','string'],
            'facility_name' => ['nullable','string','max:255'],
            'treatment_date' => ['nullable','date'],
            'outcome' => ['nullable','string','max:255'],
        ];
    }
}
