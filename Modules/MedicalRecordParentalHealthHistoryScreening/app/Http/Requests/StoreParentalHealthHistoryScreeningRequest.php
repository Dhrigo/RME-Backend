<?php

namespace Modules\MedicalRecordParentalHealthHistoryScreening\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParentalHealthHistoryScreeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'screened_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'father_health_conditions' => ['nullable','string'],
            'mother_health_conditions' => ['nullable','string'],
            'consanguinity' => ['nullable','boolean'],
            'genetic_disorder_history' => ['nullable','string'],
            'screened_at' => ['nullable','date'],
        ];
    }
}
