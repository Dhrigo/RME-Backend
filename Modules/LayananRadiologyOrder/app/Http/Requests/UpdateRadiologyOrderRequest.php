<?php

namespace Modules\LayananRadiologyOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRadiologyOrderRequest extends FormRequest
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
            'ordering_doctor_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'ordered_at' => ['sometimes', 'date'],
            'clinical_notes' => ['sometimes', 'string'],
            'status' => ['sometimes', Rule::in(['pending', 'in_progress', 'completed', 'cancelled'])],
        ];
    }
}
