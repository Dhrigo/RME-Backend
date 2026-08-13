<?php

namespace Modules\LayananAntimicrobialStewardshipPriorHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntimicrobialStewardshipPriorHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'previous_antibiotic' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'outcome' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
