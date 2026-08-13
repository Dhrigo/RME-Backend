<?php

namespace Modules\MedicalRecordToeExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToeExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'foot_side' => 'nullable|string|max:20',
            'deformity' => 'nullable|string|max:100',
            'ulceration' => 'nullable|boolean',
            'capillary_refill_seconds' => 'nullable|numeric',
            'sensation_monofilament' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
