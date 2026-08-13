<?php

namespace Modules\MedicalRecordNutritionDietPattern\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNutritionDietPatternRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'diet_type' => ['required','string','max:255'],
            'appetite' => ['nullable','in:good,fair,poor'],
            'meal_frequency_per_day' => ['nullable','integer','min:1','max:10'],
            'food_allergies' => ['nullable','string','max:255'],
            'special_diet_notes' => ['nullable','string'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
