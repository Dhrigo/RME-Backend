<?php

namespace Modules\PendaftaranPatientEscortIdentityCard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PendaftaranPatientEscortIdentityCard\Models\PatientEscortIdentityCard;

class UpdatePatientEscortIdentityCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'card_type' => [
                'sometimes',
                Rule::in(PatientEscortIdentityCard::CARD_TYPES),
                Rule::unique('patient_escort_identity_cards')
                    ->where('patient_escort_id', $this->route('patient_escort_identity_card')->patient_escort_id)
                    ->ignore($this->route('patient_escort_identity_card')->id),
            ],
            'card_number' => ['sometimes', 'string', 'max:255'],
            'issued_date' => ['nullable', 'date'],
            'address' => ['nullable', 'string', 'max:255'],
            'rt' => ['nullable', 'string', 'max:3'],
            'rw' => ['nullable', 'string', 'max:3'],
            'postal_code' => ['nullable', 'string', 'max:5'],
            'region_code' => ['nullable', 'string', 'max:10'],
        ];
    }
}
