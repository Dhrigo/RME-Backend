<?php

namespace Modules\MedicalRecordAnesthesiaPreparation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnesthesiaPreparationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'prepared_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'fasting_hours' => ['nullable','integer','min:0','max:48'],
            'allergy_checked' => ['nullable','boolean'],
            'mallampati_score' => ['nullable','integer','between:1,4'],
            'consent_confirmed' => ['nullable','boolean'],
            'equipment_checklist' => ['nullable','string'],
            'prepared_at' => ['nullable','date'],
        ];
    }
}
