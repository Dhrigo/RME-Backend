<?php

namespace Modules\MedicalRecordFoodAllergenExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodAllergenExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'patient_id' => 'sometimes|required|integer',
            'food_item' => 'sometimes|required|string|max:255',
            'reaction_grade' => 'nullable|string|max:50',
            'wheal_diameter_mm' => 'nullable|numeric',
            'symptoms_observed' => 'nullable|string',
            'interpretation' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
