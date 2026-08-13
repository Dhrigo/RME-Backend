<?php

namespace Modules\BerkasKlaimClinicalLabClaimItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicalLabClaimItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clinical_lab_claim_id' => ['required', 'integer', 'exists:clinical_lab_claims,id'],
            'test_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
