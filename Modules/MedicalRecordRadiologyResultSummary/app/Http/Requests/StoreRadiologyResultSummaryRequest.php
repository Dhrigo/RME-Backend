<?php

namespace Modules\MedicalRecordRadiologyResultSummary\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyResultSummaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'summarized_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'overall_impression' => ['nullable','string'],
            'summarized_at' => ['nullable','date'],
        ];
    }
}
