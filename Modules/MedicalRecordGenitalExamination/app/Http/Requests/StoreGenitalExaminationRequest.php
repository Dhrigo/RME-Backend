<?php

namespace Modules\MedicalRecordGenitalExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenitalExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'external_genitalia' => 'nullable|string',
            'discharge_characteristics' => 'nullable|string|max:100',
            'lesions_or_masses' => 'nullable|string',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
