<?php

namespace Modules\MedicalRecordInterventionProtocol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionProtocolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'started_by' => ['required', 'integer', 'exists:employees,id'],
            'created_by' => ['nullable', 'integer', 'exists:users,id'],
            'protocol_name' => ['required','string','max:255'],
            'indication' => ['nullable','string'],
            'status' => ['nullable','in:active,completed,discontinued'],
            'started_at' => ['nullable','date'],
        ];
    }
}
