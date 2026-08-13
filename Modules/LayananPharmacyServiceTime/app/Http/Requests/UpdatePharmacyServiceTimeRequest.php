<?php

namespace Modules\LayananPharmacyServiceTime\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyServiceTimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'received_at' => ['nullable', 'date'],
            'prepared_at' => ['nullable', 'date'],
            'dispensed_at' => ['nullable', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
