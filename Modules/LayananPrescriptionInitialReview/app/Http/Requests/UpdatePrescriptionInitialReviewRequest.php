<?php

namespace Modules\LayananPrescriptionInitialReview\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionInitialReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'reviewed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'reviewed_at' => ['sometimes', 'date'],
            'is_appropriate' => ['sometimes', 'boolean'],
            'issues_found' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
