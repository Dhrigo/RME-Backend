<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMorseFallScaleAssessmentRequest extends FormRequest
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
            'history_of_falling' => ['required','in:0,25'],
            'secondary_diagnosis' => ['required','in:0,15'],
            'ambulatory_aid' => ['required','in:0,15,30'],
            'iv_therapy' => ['required','in:0,20'],
            'gait' => ['required','in:0,10,20'],
            'mental_status' => ['required','in:0,15'],
            'total_score' => ['required','integer','min:0','max:125'],
            'risk_level' => ['required','in:LOW,MODERATE,HIGH'],
            'assessed_at' => ['nullable','date'],
        ];
    }
}
