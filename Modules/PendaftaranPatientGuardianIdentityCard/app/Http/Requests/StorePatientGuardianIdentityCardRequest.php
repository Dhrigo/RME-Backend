<?php

namespace Modules\PendaftaranPatientGuardianIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientGuardianIdentityCard\Models\PatientGuardianIdentityCard;

class StorePatientGuardianIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_guardian_id' => [
                'required', 'integer', 'exists:patient_guardians,id',
                Rule::unique('patient_guardian_identity_cards')->where('card_type', $this->input('card_type')),
            ],
            'card_type' => ['required', Rule::in(PatientGuardianIdentityCard::CARD_TYPES)],
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
