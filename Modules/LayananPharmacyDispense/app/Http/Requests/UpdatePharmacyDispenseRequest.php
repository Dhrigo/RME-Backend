<?php

namespace Modules\LayananPharmacyDispense\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePharmacyDispenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'dispensed_by' => ['sometimes', 'integer', 'exists:users,id'],
            'dispensed_at' => ['sometimes', 'date'],
            'quantity' => ['sometimes', 'integer'],
            'status' => ['sometimes', Rule::in(['pending', 'dispensed', 'cancelled'])],
        ];
    }
}
