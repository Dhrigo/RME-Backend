<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAntimicrobialStewardshipFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'requesting_doctor_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'antibiotic_restriction_id' => ['sometimes', 'integer', 'exists:antibiotic_restrictions,id'],
            'indication' => ['sometimes', 'string'],
            'status' => ['sometimes', Rule::in(['draft', 'submitted', 'approved', 'rejected'])],
            'submitted_at' => ['sometimes', 'date'],
        ];
    }
}
