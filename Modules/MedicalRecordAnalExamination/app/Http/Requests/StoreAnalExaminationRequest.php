<?php

namespace Modules\MedicalRecordAnalExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnalExaminationRequest extends FormRequest
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
            'palpation' => 'nullable|string',
            'sphincter_tone' => 'nullable|string|max:100',
            'rectal_toucher_findings' => 'nullable|string',
            'ampulla_recti' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
