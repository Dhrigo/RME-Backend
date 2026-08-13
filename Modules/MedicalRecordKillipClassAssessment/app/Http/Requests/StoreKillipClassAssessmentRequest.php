<?php

namespace Modules\MedicalRecordKillipClassAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKillipClassAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'killip_class' => ['required','integer','between:1,4'],
            'heart_rate' => ['nullable','integer','min:0','max:300'],
            'respiratory_rate' => ['nullable','integer','min:0','max:100'],
            'rales_present' => ['nullable','boolean'],
            's3_gallop_present' => ['nullable','boolean'],
            'notes' => ['nullable','string'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
