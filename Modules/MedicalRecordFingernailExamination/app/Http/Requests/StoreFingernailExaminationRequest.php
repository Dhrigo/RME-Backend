<?php

namespace Modules\MedicalRecordFingernailExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFingernailExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'color' => 'nullable|string|max:50',
            'capillary_refill_seconds' => 'nullable|integer|min:0|max:10',
            'clubbing' => 'boolean',
            'cyanosis' => 'boolean',
            'lesions' => 'nullable|string|max:150',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
