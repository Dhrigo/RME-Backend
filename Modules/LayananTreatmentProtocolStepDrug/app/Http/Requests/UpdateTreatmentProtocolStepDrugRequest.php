<?php

namespace Modules\LayananTreatmentProtocolStepDrug\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentProtocolStepDrugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'treatment_protocol_step_id' => ['sometimes', 'integer', 'exists:treatment_protocol_steps,id'],
            'drug_name' => ['sometimes', 'string', 'max:150'],
            'dosage' => ['sometimes', 'string', 'max:50'],
            'frequency' => ['sometimes', 'string', 'max:50'],
            'route' => ['nullable', 'string', 'max:50'],
        ];
    }
}
