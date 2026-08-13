<?php

namespace Modules\MedicalRecordAbdomenExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbdomenExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'inspection' => 'nullable|string',
            'auscultation_bowel_sounds' => 'nullable|string|max:50',
            'palpation' => 'nullable|string',
            'percussion' => 'nullable|string|max:50',
            'tenderness' => 'boolean',
            'distension' => 'boolean',
            'liver_span_cm' => 'nullable|numeric|min:0|max:40',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
