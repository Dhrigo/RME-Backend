<?php

namespace Modules\MedicalRecordBaepCognitiveDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepCognitiveDetailRequest extends FormRequest
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
            'score' => ['required','integer','min:0','max:30'],
            'domains_affected' => ['nullable','string','max:255'],
        ];
    }
}
