<?php

namespace Modules\PendaftaranCoManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoManagementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'started_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
