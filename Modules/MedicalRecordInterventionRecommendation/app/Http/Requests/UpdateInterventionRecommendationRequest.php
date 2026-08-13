<?php

namespace Modules\MedicalRecordInterventionRecommendation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterventionRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'source' => ['nullable', 'string', 'max:100'],
            'recommendation' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'max:20'],
            'recommended_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'recommended_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
