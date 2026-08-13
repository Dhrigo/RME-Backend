<?php

namespace Modules\MedicalRecordImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'order_reference' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'performed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'performed_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
