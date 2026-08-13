<?php

namespace Modules\MedicalRecordPlanAndTherapy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanAndTherapyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'ordered_by' => ['required', 'integer', 'exists:doctors,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'assessment_summary' => ['nullable','string'],
            'plan_description' => ['required','string'],
            'therapy_type' => ['nullable','string','max:255'],
            'target_date' => ['nullable','date'],
            'status' => ['nullable','in:active,completed,revised'],
            'ordered_at' => ['nullable','date'],
        ];
    }
}
