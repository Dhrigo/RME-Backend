<?php

namespace Modules\BerkasKlaimRadiologyClaimItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRadiologyClaimItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'radiology_claim_id' => ['required', 'integer', 'exists:radiology_claims,id'],
            'exam_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
