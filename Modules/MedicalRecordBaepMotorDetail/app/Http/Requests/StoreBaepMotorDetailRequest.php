<?php

namespace Modules\MedicalRecordBaepMotorDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepMotorDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'baep_protocol_id' => ['required', 'integer', 'exists:baep_intervention_protocols,id'],
            'muscle_strength_score' => ['nullable','integer','between:0,5'],
            'spasticity_level' => ['nullable','in:0,1,1+,2,3,4'],
            'gait_status' => ['nullable','string','max:255'],
        ];
    }
}
