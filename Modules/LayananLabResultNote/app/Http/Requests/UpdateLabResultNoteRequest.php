<?php

namespace Modules\LayananLabResultNote\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLabResultNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lab_result_id' => ['sometimes', 'integer', 'exists:lab_results,id'],
            'note' => ['sometimes', 'string'],
            'created_by' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
