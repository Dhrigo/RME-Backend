<?php

namespace Modules\PendaftaranReferral\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferralRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'direction' => ['required', 'string', 'in:incoming,outgoing'],
            'facility_name' => ['required', 'string', 'max:255'],
            'reason' => ['nullable', 'string'],
            'referred_at' => ['nullable', 'date'],
        ];
    }
}
