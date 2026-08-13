<?php

namespace Modules\MedicalRecordFamilyPlanningObstetrics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFamilyPlanningObstetricsRequest extends FormRequest
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
            'contraceptive_method' => 'sometimes|required|string|max:100',
            'installation_date' => 'nullable|date',
            'removal_date' => 'nullable|date',
            'side_effects' => 'nullable|string',
            'action_taken' => 'nullable|string',
            'next_visit_date' => 'nullable|date',
        ];
    }
}
