<?php

namespace Modules\LayananPrescriptionFulfillment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrescriptionFulfillmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'served_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'served_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
