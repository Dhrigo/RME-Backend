<?php

namespace Modules\MedicalRecordInhalantAllergenExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInhalantAllergenExaminationRequest extends FormRequest
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
            'allergen_name' => 'required|string|max:255',
            'reaction_grade' => 'nullable|string|max:50',
            'wheal_diameter_mm' => 'nullable|numeric',
            'erythema_diameter_mm' => 'nullable|numeric',
            'interpretation' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
