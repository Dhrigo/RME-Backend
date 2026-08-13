<?php

namespace Modules\MedicalRecordSkinPrickTestExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkinPrickTestExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'allergen' => 'sometimes|required|string|max:150',
            'wheal_size_mm' => 'nullable|numeric|min:0|max:50',
            'flare_size_mm' => 'nullable|numeric|min:0|max:100',
            'result' => 'nullable|string|in:positive,negative,equivocal',
            'reaction_onset_minutes' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
            'tested_at' => 'nullable|date',
        ];
    }
}
