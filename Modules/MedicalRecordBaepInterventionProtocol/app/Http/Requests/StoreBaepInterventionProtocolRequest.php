<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepInterventionProtocolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'performed_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'indication' => ['nullable','string'],
            'stimulation_ear' => ['required','in:left,right,bilateral'],
            'click_rate_hz' => ['nullable','numeric','min:0'],
            'stimulus_intensity_db' => ['nullable','integer','min:0','max:130'],
            'wave_i_latency_ms' => ['nullable','numeric'],
            'wave_iii_latency_ms' => ['nullable','numeric'],
            'wave_v_latency_ms' => ['nullable','numeric'],
            'interpretation' => ['nullable','string'],
            'status' => ['nullable','in:in_progress,completed'],
            'performed_at' => ['nullable','date'],
        ];
    }
}
