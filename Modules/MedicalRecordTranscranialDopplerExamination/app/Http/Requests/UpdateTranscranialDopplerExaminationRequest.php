<?php

namespace Modules\MedicalRecordTranscranialDopplerExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTranscranialDopplerExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => 'sometimes|required|integer',
            'indication' => 'nullable|string|max:150',
            'vessel' => 'nullable|string|in:MCA,ACA,PCA,ICA,VA,BA',
            'mean_velocity_cm_s' => 'nullable|numeric|min:0',
            'pulsatility_index' => 'nullable|numeric|min:0',
            'findings' => 'nullable|string',
            'examined_at' => 'nullable|date',
        ];
    }
}
