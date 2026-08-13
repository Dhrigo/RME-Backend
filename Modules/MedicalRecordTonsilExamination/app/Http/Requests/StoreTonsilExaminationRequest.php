<?php

namespace Modules\MedicalRecordTonsilExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTonsilExaminationRequest extends FormRequest
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
            'grade' => 'nullable|integer|min:0|max:4',
            'color' => 'nullable|string|max:50',
            'exudate' => 'boolean',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
