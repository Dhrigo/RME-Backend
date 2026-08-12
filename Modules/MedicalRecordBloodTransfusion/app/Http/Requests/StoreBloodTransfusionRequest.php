<?php

namespace Modules\MedicalRecordBloodTransfusion\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBloodTransfusionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'blood_type_id' => ['required', 'integer', 'exists:blood_types,id'],
            'volume_ml' => ['nullable', 'integer', 'min:0'],
            'started_at' => ['nullable', 'date'],
            'administered_by' => ['required', 'integer', 'exists:employees,id'],
            'reaction_notes' => ['nullable', 'string'],
        ];
    }
}
