<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEndOfLifeEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'topic' => ['sometimes', 'string', 'max:150'],
            'participants' => ['nullable', 'string'],
            'decision_summary' => ['nullable', 'string'],
            'educator_id' => ['sometimes', 'integer', 'exists:employees,id'],
            'educated_at' => ['sometimes', 'date'],
        ];
    }
}
