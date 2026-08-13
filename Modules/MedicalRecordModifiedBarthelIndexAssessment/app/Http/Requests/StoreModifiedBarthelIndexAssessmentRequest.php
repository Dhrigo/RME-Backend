<?php

namespace Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModifiedBarthelIndexAssessmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'feeding' => 'nullable|integer|min:0|max:10',
            'bathing' => 'nullable|integer|min:0|max:5',
            'personal_hygiene' => 'nullable|integer|min:0|max:5',
            'dressing' => 'nullable|integer|min:0|max:10',
            'bowel_control' => 'nullable|integer|min:0|max:10',
            'bladder_control' => 'nullable|integer|min:0|max:10',
            'toilet_use' => 'nullable|integer|min:0|max:10',
            'chair_bed_transfer' => 'nullable|integer|min:0|max:15',
            'ambulation' => 'nullable|integer|min:0|max:15',
            'stairs' => 'nullable|integer|min:0|max:10',
            'total_score' => 'nullable|integer|min:0|max:100',
            'interpretation' => 'nullable|string|max:30',
            'assessed_at' => 'nullable|date',
        ];
    }
}
