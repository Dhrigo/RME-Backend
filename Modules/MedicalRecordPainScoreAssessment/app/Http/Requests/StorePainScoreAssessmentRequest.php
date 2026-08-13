<?php

namespace Modules\MedicalRecordPainScoreAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePainScoreAssessmentRequest extends FormRequest
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
            'scale_type' => ['required','in:NRS,WONG_BAKER,FLACC,CRIES'],
            'score' => ['required','integer','between:0,10'],
            'location' => ['nullable','string','max:255'],
            'character' => ['nullable','string','max:255'],
            'notes' => ['nullable','string'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
