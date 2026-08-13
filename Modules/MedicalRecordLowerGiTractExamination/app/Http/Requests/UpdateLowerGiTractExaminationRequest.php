<?php

namespace Modules\MedicalRecordLowerGiTractExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLowerGiTractExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'procedure_type' => 'nullable|string|max:50',
            'colon_findings' => 'nullable|string',
            'rectum_findings' => 'nullable|string',
            'polyps_found' => 'boolean',
            'biopsy_taken' => 'boolean',
            'examined_at' => 'nullable|date',
        ];
    }
}
