<?php

namespace Modules\LayananLabResultNote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLabResultNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_result_id' => ['required', 'integer', 'exists:lab_results,id'],
            'note' => ['required', 'string'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
