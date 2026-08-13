<?php

namespace Modules\BerkasKlaimPharmacyClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyClaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'claim_file_id' => ['required', 'integer', 'exists:claim_files,id'],
            'prescription_id' => ['nullable', 'integer', 'exists:prescriptions,id'],
            'submitted_at' => ['nullable', 'date'],
        ];
    }
}
