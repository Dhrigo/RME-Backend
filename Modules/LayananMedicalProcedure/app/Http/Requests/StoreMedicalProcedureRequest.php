<?php

namespace Modules\LayananMedicalProcedure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalProcedureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'performed_at' => ['nullable', 'date'],
            'performed_by' => ['required', 'integer', 'exists:employees,id'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:completed,cancelled'],
        ];
    }
}
