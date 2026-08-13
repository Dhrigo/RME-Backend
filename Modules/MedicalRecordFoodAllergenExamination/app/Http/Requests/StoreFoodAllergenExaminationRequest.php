<?php

namespace Modules\MedicalRecordFoodAllergenExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodAllergenExaminationRequest extends FormRequest
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
            'food_item' => 'required|string|max:255',
            'reaction_grade' => 'nullable|string|max:50',
            'wheal_diameter_mm' => 'nullable|numeric',
            'symptoms_observed' => 'nullable|string',
            'interpretation' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
