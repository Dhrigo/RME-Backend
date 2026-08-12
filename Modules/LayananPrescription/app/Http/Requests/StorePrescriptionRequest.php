<?php

namespace Modules\LayananPrescription\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_number' => ['nullable', 'string', 'max:255', 'unique:prescriptions,prescription_number'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_id' => ['nullable', 'integer', 'exists:diagnoses,id'],
            'prescribed_by' => ['required', 'integer', 'exists:employees,id'],
            'prescribed_at' => ['nullable', 'date'],
            'weight_kg' => ['nullable', 'numeric', 'min:0'],
            'height_cm' => ['nullable', 'numeric', 'min:0'],
            'has_drug_allergy' => ['sometimes', 'boolean'],
            'is_pregnant' => ['sometimes', 'boolean'],
            'is_breastfeeding' => ['sometimes', 'boolean'],
            'is_discharge_prescription' => ['sometimes', 'boolean'],
            'is_emergency' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
