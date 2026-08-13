<?php

namespace Modules\LayananPharmacyDispense\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePharmacyDispenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'dispensed_by' => ['nullable', 'integer', 'exists:users,id'],
            'dispensed_at' => ['nullable', 'date'],
            'quantity' => ['required', 'integer'],
            'status' => ['required', Rule::in(['pending', 'dispensed', 'cancelled'])],
        ];
    }
}
