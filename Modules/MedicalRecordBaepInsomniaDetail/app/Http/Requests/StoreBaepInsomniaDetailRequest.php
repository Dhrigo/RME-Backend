<?php

namespace Modules\MedicalRecordBaepInsomniaDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepInsomniaDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'baep_protocol_id' => ['required', 'integer', 'exists:baep_intervention_protocols,id'],
            'scale_used' => ['nullable','string','max:40'],
            'score' => ['required','integer','min:0'],
            'sleep_onset_latency_minutes' => ['nullable','integer','min:0'],
            'sleep_efficiency_percent' => ['nullable','integer','min:0','max:100'],
        ];
    }
}
