<?php

namespace Modules\LayananTreatmentProtocol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentProtocolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'protocol_name' => ['required', 'string', 'max:150'],
            'prescribed_by' => ['required', 'integer', 'exists:employees,id'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
