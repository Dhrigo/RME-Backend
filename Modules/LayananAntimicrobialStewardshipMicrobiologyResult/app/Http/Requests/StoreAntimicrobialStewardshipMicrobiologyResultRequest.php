<?php

namespace Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntimicrobialStewardshipMicrobiologyResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'specimen_type' => ['required', 'string', 'max:255'],
            'organism_found' => ['nullable', 'string', 'max:255'],
            'sensitivity_result' => ['nullable', 'string'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
