<?php

namespace Modules\LayananRadiologyOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRadiologyOrderRequest extends FormRequest
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
            'ordering_doctor_id' => ['nullable', 'integer', 'exists:employees,id'],
            'ordered_at' => ['required', 'date'],
            'clinical_notes' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed', 'cancelled'])],
        ];
    }
}
