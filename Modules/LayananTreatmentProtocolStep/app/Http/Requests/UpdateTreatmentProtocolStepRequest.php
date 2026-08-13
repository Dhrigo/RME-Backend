<?php

namespace Modules\LayananTreatmentProtocolStep\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTreatmentProtocolStepRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'treatment_protocol_id' => ['sometimes', 'integer', 'exists:treatment_protocols,id'],
            'sequence' => ['sometimes', 'integer'],
            'instruction' => ['sometimes', 'string', 'max:255'],
            'scheduled_at' => ['nullable', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
