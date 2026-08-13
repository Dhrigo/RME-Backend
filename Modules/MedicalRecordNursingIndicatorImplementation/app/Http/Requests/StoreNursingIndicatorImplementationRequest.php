<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingIndicatorImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nursing_indicator_id' => ['required', 'integer', 'exists:nursing_indicators,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'value_recorded' => ['required', 'string', 'max:100'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
            'recorded_at' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
