<?php

namespace Modules\MedicalRecordFingerExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFingerExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'required|integer',
            'hand_side' => 'nullable|string|max:20',
            'clubbing' => 'nullable|boolean',
            'cyanosis' => 'nullable|boolean',
            'capillary_refill_seconds' => 'nullable|numeric',
            'range_of_motion' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
