<?php

namespace Modules\MedicalRecordBaepDysphagiaDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBaepDysphagiaDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'baep_protocol_id' => ['required', 'integer', 'exists:baep_intervention_protocols,id'],
            'swallowing_test_used' => ['nullable','string','max:40'],
            'severity_level' => ['nullable','in:none,mild,moderate,severe'],
            'aspiration_risk' => ['nullable','boolean'],
            'diet_texture_recommendation' => ['nullable','string','max:255'],
        ];
    }
}
