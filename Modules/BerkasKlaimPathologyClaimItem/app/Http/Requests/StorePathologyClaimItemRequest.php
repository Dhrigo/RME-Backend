<?php

namespace Modules\BerkasKlaimPathologyClaimItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePathologyClaimItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pathology_claim_id' => ['required', 'integer', 'exists:pathology_claims,id'],
            'exam_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
