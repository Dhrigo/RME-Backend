<?php

namespace Modules\MedicalRecordVitalSign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVitalSignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'recorded_at' => ['nullable', 'date'],
            'temperature' => ['nullable', 'numeric', 'between:30,45'],
            'pulse' => ['nullable', 'integer', 'min:0'],
            'respiratory_rate' => ['nullable', 'integer', 'min:0'],
            'systolic' => ['nullable', 'integer', 'min:0'],
            'diastolic' => ['nullable', 'integer', 'min:0'],
            'oxygen_saturation' => ['nullable', 'integer', 'between:0,100'],
            'pain_scale' => ['nullable', 'integer', 'between:0,10'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
        ];
    }
}
