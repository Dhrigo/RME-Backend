<?php

namespace Modules\MedicalRecordAllergy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAllergyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'category' => ['required', 'string', 'in:drug,food,environment'],
            'allergen' => ['required', 'string', 'max:255'],
            'reaction' => ['nullable', 'string'],
            'severity' => ['nullable', 'string', 'in:mild,moderate,severe'],
            'recorded_by' => ['required', 'integer', 'exists:employees,id'],
        ];
    }
}
