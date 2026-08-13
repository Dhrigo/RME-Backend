<?php

namespace Modules\MedicalRecordMmpiTest\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MmpiTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'doctor_id' => ['nullable', 'integer', 'exists:doctors,id'],
            'test_date' => ['required', 'date'],
            'validity_scale_l' => ['nullable', 'integer', 'min:0'],
            'validity_scale_f' => ['nullable', 'integer', 'min:0'],
            'validity_scale_k' => ['nullable', 'integer', 'min:0'],
            'clinical_scales_summary' => ['nullable', 'array'],
            'interpretation' => ['nullable', 'string'],
            'conclusion' => ['nullable', 'string'],
        ];
    }
}
