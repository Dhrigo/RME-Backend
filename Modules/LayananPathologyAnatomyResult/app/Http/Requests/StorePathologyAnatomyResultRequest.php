<?php

namespace Modules\LayananPathologyAnatomyResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePathologyAnatomyResultRequest extends FormRequest
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
            'specimen_description' => ['required', 'string'],
            'macroscopic_finding' => ['nullable', 'string'],
            'microscopic_finding' => ['nullable', 'string'],
            'diagnosis' => ['nullable', 'string'],
            'examined_by' => ['nullable', 'integer', 'exists:employees,id'],
            'examined_at' => ['required', 'date'],
            'status' => ['required', Rule::in(['pending', 'final'])],
        ];
    }
}
