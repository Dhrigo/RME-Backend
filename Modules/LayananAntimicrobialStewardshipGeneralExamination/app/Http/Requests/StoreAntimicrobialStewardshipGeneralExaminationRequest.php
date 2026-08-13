<?php

namespace Modules\LayananAntimicrobialStewardshipGeneralExamination\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntimicrobialStewardshipGeneralExaminationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'temperature' => ['nullable', 'numeric'],
            'pulse' => ['nullable', 'integer'],
            'respiration_rate' => ['nullable', 'integer'],
            'blood_pressure' => ['nullable', 'string', 'max:255'],
            'weight_kg' => ['nullable', 'numeric'],
            'height_cm' => ['nullable', 'numeric'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
