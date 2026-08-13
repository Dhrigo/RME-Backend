<?php

namespace Modules\PendaftaranConsultation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'requesting_department_id' => ['required', 'integer', 'exists:medical_departments,id'],
            'consulted_department_id' => ['required', 'integer', 'exists:medical_departments,id', 'different:requesting_department_id'],
            'requested_at' => ['nullable', 'date'],
            'question' => ['nullable', 'string'],
        ];
    }
}
