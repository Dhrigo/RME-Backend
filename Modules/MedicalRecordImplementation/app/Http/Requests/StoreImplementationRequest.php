<?php

namespace Modules\MedicalRecordImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'order_reference' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'performed_by' => ['required', 'integer', 'exists:employees,id'],
            'performed_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
