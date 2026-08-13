<?php

namespace Modules\MedicalRecordProcedureConsentInformationItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcedureConsentInformationItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'information_id' => ['required', 'integer', 'exists:procedure_consent_information,id'],
            'item_name' => ['required','string','max:255'],
            'is_explained' => ['nullable','boolean'],
            'is_understood' => ['nullable','boolean'],
        ];
    }
}
