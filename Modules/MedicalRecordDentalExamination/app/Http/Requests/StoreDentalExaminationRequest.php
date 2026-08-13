<?php

namespace Modules\MedicalRecordDentalExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDentalExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'decayed_teeth_count' => 'nullable|integer',
            'missing_teeth_count' => 'nullable|integer',
            'filled_teeth_count' => 'nullable|integer',
            'odontogram_json' => 'nullable|array',
            'occlusion_status' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
