<?php

namespace Modules\PendaftaranConsultationAnswer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'consultation_id' => ['required', 'integer', 'exists:consultations,id'],
            'answered_by' => ['required', 'integer', 'exists:employees,id'],
            'answered_at' => ['nullable', 'date'],
            'answer' => ['nullable', 'string'],
        ];
    }
}
