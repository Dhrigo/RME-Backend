<?php

namespace Modules\MedicalRecordFamilyMedicalHistory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyMedicalHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'relation' => ['required','string','max:255'],
            'condition' => ['required','string','max:255'],
            'diagnosed_age' => ['nullable','integer','min:0','max:120'],
            'notes' => ['nullable','string'],
        ];
    }
}
