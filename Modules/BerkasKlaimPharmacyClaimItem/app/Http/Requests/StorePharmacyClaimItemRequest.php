<?php

namespace Modules\BerkasKlaimPharmacyClaimItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyClaimItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pharmacy_claim_id' => ['required', 'integer', 'exists:pharmacy_claims,id'],
            'drug_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
