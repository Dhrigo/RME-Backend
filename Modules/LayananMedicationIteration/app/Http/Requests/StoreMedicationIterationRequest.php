<?php

namespace Modules\LayananMedicationIteration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMedicationIterationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'iteration_number' => ['required', 'integer'],
            'quantity' => ['required', 'integer'],
            'dispensed_at' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['pending', 'dispensed'])],
        ];
    }
}
