<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEndOfLifeEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'topic' => ['required', 'string', 'max:150'],
            'participants' => ['nullable', 'string'],
            'decision_summary' => ['nullable', 'string'],
            'educator_id' => ['required', 'integer', 'exists:employees,id'],
            'educated_at' => ['required', 'date'],
        ];
    }
}
