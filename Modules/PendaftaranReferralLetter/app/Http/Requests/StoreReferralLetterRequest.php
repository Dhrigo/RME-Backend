<?php

namespace Modules\PendaftaranReferralLetter\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferralLetterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'from_department_id' => ['required', 'integer', 'exists:medical_departments,id'],
            'to_department_id' => ['required', 'integer', 'exists:medical_departments,id', 'different:from_department_id'],
            'issued_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
