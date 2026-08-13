<?php

namespace Modules\MedicalRecordBaepStimulationProtocolDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepStimulationProtocolDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'baep_protocol_id' => ['required', 'integer', 'exists:baep_intervention_protocols,id'],
            'stimulation_site' => ['required','string','max:255'],
            'stimulation_frequency_hz' => ['nullable','numeric','min:0'],
            'stimulation_duration_minutes' => ['nullable','integer','min:1'],
            'intensity_ma' => ['nullable','numeric','min:0'],
            'number_of_sessions' => ['nullable','integer','min:1'],
        ];
    }
}
