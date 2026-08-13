<?php

namespace Modules\LayananPathologyAnatomyResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePathologyAnatomyResultRequest extends FormRequest
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
            'specimen_description' => ['sometimes', 'string'],
            'macroscopic_finding' => ['sometimes', 'string'],
            'microscopic_finding' => ['sometimes', 'string'],
            'diagnosis' => ['sometimes', 'string'],
            'examined_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'examined_at' => ['sometimes', 'date'],
            'status' => ['sometimes', Rule::in(['pending', 'final'])],
        ];
    }
}
