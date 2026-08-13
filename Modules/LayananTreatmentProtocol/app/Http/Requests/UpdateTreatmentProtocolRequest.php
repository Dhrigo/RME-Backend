<?php

namespace Modules\LayananTreatmentProtocol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentProtocolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'protocol_name' => ['sometimes', 'string', 'max:150'],
            'prescribed_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'started_at' => ['sometimes', 'date'],
            'ended_at' => ['nullable', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
