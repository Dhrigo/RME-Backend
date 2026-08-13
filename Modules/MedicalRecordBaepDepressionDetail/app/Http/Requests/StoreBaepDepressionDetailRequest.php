<?php

namespace Modules\MedicalRecordBaepDepressionDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepDepressionDetailRequest extends FormRequest
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
            'severity_level' => ['nullable','in:minimal,mild,moderate,severe'],
            'symptoms_observed' => ['nullable','string'],
        ];
    }
}
