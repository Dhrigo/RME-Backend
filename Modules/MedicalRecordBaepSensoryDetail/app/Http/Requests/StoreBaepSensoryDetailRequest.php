<?php

namespace Modules\MedicalRecordBaepSensoryDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepSensoryDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'baep_protocol_id' => ['required', 'integer', 'exists:baep_intervention_protocols,id'],
            'sensory_modality' => ['required','in:touch,pain,vibration,proprioception'],
            'sensory_score' => ['nullable','integer','between:0,2'],
            'affected_region' => ['nullable','string','max:255'],
        ];
    }
}
