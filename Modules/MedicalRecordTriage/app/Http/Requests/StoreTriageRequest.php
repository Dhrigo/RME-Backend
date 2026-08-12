<?php

namespace Modules\MedicalRecordTriage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTriageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'level' => ['required', 'integer', 'between:1,5'],
            'chief_complaint' => ['nullable', 'string'],
            'assessed_by' => ['required', 'integer', 'exists:employees,id'],
            'assessed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
