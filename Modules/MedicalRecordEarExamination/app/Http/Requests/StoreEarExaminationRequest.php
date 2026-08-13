<?php

namespace Modules\MedicalRecordEarExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEarExaminationRequest extends FormRequest
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
            'otoscopy' => 'nullable|string',
            'tympanic_membrane' => 'nullable|string|max:100',
            'hearing_test_result' => 'nullable|string|max:100',
            'discharge' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
