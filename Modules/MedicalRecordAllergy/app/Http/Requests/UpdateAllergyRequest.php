<?php

namespace Modules\MedicalRecordAllergy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAllergyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => ['sometimes', 'string', 'in:drug,food,environment'],
            'allergen' => ['sometimes', 'string', 'max:255'],
            'reaction' => ['nullable', 'string'],
            'severity' => ['nullable', 'string', 'in:mild,moderate,severe'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
