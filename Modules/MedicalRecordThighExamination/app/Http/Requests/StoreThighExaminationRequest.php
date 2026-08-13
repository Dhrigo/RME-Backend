<?php

namespace Modules\MedicalRecordThighExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreThighExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'side' => 'nullable|string|in:left,right,bilateral',
            'muscle_strength' => 'nullable|string|max:10',
            'circumference_cm' => 'nullable|numeric|min:0',
            'swelling' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
