<?php

namespace Modules\LayananRadiologyViewerLog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyViewerLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'accession_number' => ['nullable', 'string', 'max:100'],
            'viewed_by' => ['required', 'integer', 'exists:employees,id'],
            'viewed_at' => ['required', 'date'],
            'ip_address' => ['nullable', 'string', 'max:45'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
