<?php

namespace Modules\LayananPrescriptionFulfillment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionFulfillmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'served_by' => ['required', 'integer', 'exists:employees,id'],
            'served_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
