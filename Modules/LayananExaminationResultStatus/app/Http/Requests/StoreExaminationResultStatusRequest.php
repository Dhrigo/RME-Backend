<?php

namespace Modules\LayananExaminationResultStatus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExaminationResultStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'examination_type' => ['required', 'string', 'max:100'],
            'status' => ['sometimes', 'string', 'max:255'],
            'verified_by' => ['nullable', 'integer', 'exists:employees,id'],
            'verified_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
