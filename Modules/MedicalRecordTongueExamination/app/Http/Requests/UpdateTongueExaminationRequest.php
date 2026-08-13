<?php

namespace Modules\MedicalRecordTongueExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTongueExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'color' => 'nullable|string|max:50',
            'coating' => 'nullable|string|max:100',
            'moisture' => 'nullable|string|max:50',
            'lesions' => 'nullable|string|max:150',
            'movement' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
