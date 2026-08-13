<?php

namespace Modules\MedicalRecordEkgExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEkgExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'patient_id' => 'sometimes|required|integer',
            'heart_rate_bpm' => 'nullable|integer',
            'rhythm' => 'nullable|string|max:100',
            'p_wave' => 'nullable|string|max:100',
            'pr_interval_ms' => 'nullable|integer',
            'qrs_duration_ms' => 'nullable|integer',
            'st_segment' => 'nullable|string|max:100',
            't_wave' => 'nullable|string|max:100',
            'conclusion' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
