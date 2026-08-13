<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GynecologyUltrasoundRequest extends FormRequest
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
            'exam_date' => ['required', 'date'],
            'uterus_findings' => ['nullable', 'string'],
            'right_ovary_findings' => ['nullable', 'string'],
            'left_ovary_findings' => ['nullable', 'string'],
            'endometrial_thickness_mm' => ['nullable', 'numeric', 'min:0'],
            'conclusion' => ['nullable', 'string'],
        ];
    }
}
