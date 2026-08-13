<?php

namespace Modules\LayananAntimicrobialStewardshipLabResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntimicrobialStewardshipLabResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'lab_result_id' => ['nullable', 'integer', 'exists:lab_results,id'],
            'examination_name' => ['required', 'string', 'max:255'],
            'result_value' => ['required', 'string', 'max:255'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
