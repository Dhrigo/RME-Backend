<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInhalantAllergenExaminationRequest extends FormRequest
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
            'allergen_name' => 'sometimes|required|string|max:255',
            'reaction_grade' => 'nullable|string|max:50',
            'wheal_diameter_mm' => 'nullable|numeric',
            'erythema_diameter_mm' => 'nullable|numeric',
            'interpretation' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
