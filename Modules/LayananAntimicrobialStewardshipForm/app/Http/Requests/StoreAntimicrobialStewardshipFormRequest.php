<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAntimicrobialStewardshipFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'requesting_doctor_id' => ['nullable', 'integer', 'exists:employees,id'],
            'antibiotic_restriction_id' => ['nullable', 'integer', 'exists:antibiotic_restrictions,id'],
            'indication' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'submitted', 'approved', 'rejected'])],
            'submitted_at' => ['nullable', 'date'],
        ];
    }
}
