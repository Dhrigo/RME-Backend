<?php

namespace Modules\LayananMedicationIteration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMedicationIterationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'iteration_number' => ['sometimes', 'integer'],
            'quantity' => ['sometimes', 'integer'],
            'dispensed_at' => ['sometimes', 'date'],
            'status' => ['sometimes', Rule::in(['pending', 'dispensed'])],
        ];
    }
}
