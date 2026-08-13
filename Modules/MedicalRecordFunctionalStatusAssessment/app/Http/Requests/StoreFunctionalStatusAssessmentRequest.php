<?php

namespace Modules\MedicalRecordFunctionalStatusAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFunctionalStatusAssessmentRequest extends FormRequest
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
            'bathing_status' => ['nullable','in:independent,assisted,dependent'],
            'dressing_status' => ['nullable','in:independent,assisted,dependent'],
            'toileting_status' => ['nullable','in:independent,assisted,dependent'],
            'transferring_status' => ['nullable','in:independent,assisted,dependent'],
            'feeding_status' => ['nullable','in:independent,assisted,dependent'],
            'total_score' => ['nullable','integer','min:0'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
