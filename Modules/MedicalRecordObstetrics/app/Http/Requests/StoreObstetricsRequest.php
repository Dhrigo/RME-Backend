<?php

namespace Modules\MedicalRecordObstetrics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObstetricsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'patient_id' => 'required|integer',
            'gravida' => 'nullable|integer',
            'para' => 'nullable|integer',
            'abortus' => 'nullable|integer',
            'gestational_age_weeks' => 'nullable|numeric',
            'fundal_height_cm' => 'nullable|numeric',
            'fetal_heart_rate' => 'nullable|integer',
            'fetal_presentation' => 'nullable|string|max:100',
            'estimated_fetal_weight' => 'nullable|integer',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
