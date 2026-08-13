<?php

namespace Modules\LayananPharmacyOutpatientQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePharmacyOutpatientQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'queue_number' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(['waiting', 'called', 'done'])],
            'called_at' => ['nullable', 'date'],
            'completed_at' => ['nullable', 'date'],
        ];
    }
}
