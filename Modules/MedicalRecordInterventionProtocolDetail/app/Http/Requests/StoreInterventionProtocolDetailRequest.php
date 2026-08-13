<?php

namespace Modules\MedicalRecordInterventionProtocolDetail\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionProtocolDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'protocol_id' => ['required', 'integer', 'exists:intervention_protocols,id'],
            'performed_by' => ['required', 'integer', 'exists:employees,id'],
            'step_number' => ['required','integer','min:1'],
            'step_description' => ['required','string'],
            'result_notes' => ['nullable','string'],
            'performed_at' => ['nullable','date'],
        ];
    }
}
