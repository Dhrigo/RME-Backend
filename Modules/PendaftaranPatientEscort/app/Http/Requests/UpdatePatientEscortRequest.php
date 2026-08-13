<?php

namespace Modules\PendaftaranPatientEscort\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;

class UpdatePatientEscortRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['sometimes', 'string', 'max:255'],
            'relationship_to_patient' => ['sometimes', Rule::in(PatientEscort::RELATIONSHIP_TYPES)],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'arrival_mode' => ['sometimes', Rule::in(PatientEscort::ARRIVAL_MODES)],
            'notes' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
