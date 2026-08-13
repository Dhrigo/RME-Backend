<?php

namespace Modules\MedicalRecordEyeExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEyeExaminationRequest extends FormRequest
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
            'visual_acuity' => 'nullable|string|max:20',
            'pupil_size_mm' => 'nullable|numeric|min:0|max:12',
            'pupil_reflex' => 'nullable|string|max:50',
            'conjunctiva' => 'nullable|string|max:100',
            'sclera' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
