<?php

namespace Modules\LayananPharmacyOutpatientQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePharmacyOutpatientQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'queue_number' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', Rule::in(['waiting', 'called', 'done'])],
            'called_at' => ['sometimes', 'date'],
            'completed_at' => ['sometimes', 'date'],
        ];
    }
}
