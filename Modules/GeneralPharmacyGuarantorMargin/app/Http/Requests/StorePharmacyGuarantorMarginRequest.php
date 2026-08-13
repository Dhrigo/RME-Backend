<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyGuarantorMarginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guarantor_id' => ['required', 'integer', 'exists:guarantors,id'],
            'margin_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
