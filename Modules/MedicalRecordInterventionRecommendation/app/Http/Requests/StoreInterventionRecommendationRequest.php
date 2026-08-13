<?php

namespace Modules\MedicalRecordInterventionRecommendation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'source' => ['nullable', 'string', 'max:100'],
            'recommendation' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'max:20'],
            'recommended_by' => ['required', 'integer', 'exists:employees,id'],
            'recommended_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
