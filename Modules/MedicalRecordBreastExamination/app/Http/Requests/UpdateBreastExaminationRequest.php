<?php

namespace Modules\MedicalRecordBreastExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBreastExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'side' => 'nullable|string|in:left,right,bilateral',
            'inspection' => 'nullable|string',
            'palpation' => 'nullable|string',
            'lump_present' => 'boolean',
            'nipple_discharge' => 'nullable|string|max:100',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
