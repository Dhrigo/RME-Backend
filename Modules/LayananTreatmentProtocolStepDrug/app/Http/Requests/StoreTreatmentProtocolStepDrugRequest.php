<?php

namespace Modules\LayananTreatmentProtocolStepDrug\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentProtocolStepDrugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'treatment_protocol_step_id' => ['required', 'integer', 'exists:treatment_protocol_steps,id'],
            'drug_name' => ['required', 'string', 'max:150'],
            'dosage' => ['required', 'string', 'max:50'],
            'frequency' => ['required', 'string', 'max:50'],
            'route' => ['nullable', 'string', 'max:50'],
        ];
    }
}
