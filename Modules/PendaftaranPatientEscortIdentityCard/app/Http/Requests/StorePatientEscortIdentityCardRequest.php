<?php

namespace Modules\PendaftaranPatientEscortIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientEscortIdentityCard\Models\PatientEscortIdentityCard;

class StorePatientEscortIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_escort_id' => [
                'required', 'integer', 'exists:patient_escorts,id',
                Rule::unique('patient_escort_identity_cards')->where('card_type', $this->input('card_type')),
            ],
            'card_type' => ['required', Rule::in(PatientEscortIdentityCard::CARD_TYPES)],
            'card_number' => ['required', 'string', 'max:255'],
            'issued_date' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:3'],
            'rw' => ['nullable', 'string', 'max:3'],
            'postal_code' => ['nullable', 'string', 'max:5'],
            'region_code' => ['nullable', 'string', 'max:10'],
        ];
    }
}
