<?php

namespace Modules\LayananMedicalProcedure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicalProcedureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
