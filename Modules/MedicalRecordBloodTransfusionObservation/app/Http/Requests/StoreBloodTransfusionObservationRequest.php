<?php

namespace Modules\MedicalRecordBloodTransfusionObservation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBloodTransfusionObservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blood_transfusion_id' => 'required|integer',
            'observed_at' => 'required|date',
            'temperature_c' => 'nullable|numeric|min:30|max:45',
            'pulse_rate' => 'nullable|integer|min:0|max:300',
            'blood_pressure' => 'nullable|string|max:20',
            'reaction_signs' => 'nullable|string|max:150',
            'volume_transfused_ml' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
