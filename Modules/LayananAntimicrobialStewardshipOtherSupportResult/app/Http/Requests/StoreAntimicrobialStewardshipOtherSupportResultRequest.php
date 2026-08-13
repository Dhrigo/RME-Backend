<?php

namespace Modules\LayananAntimicrobialStewardshipOtherSupportResult\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntimicrobialStewardshipOtherSupportResultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'antimicrobial_stewardship_form_id' => ['required', 'integer', 'exists:antimicrobial_stewardship_forms,id'],
            'examination_name' => ['required', 'string', 'max:255'],
            'result_value' => ['required', 'string'],
            'examined_at' => ['required', 'date'],
        ];
    }
}
