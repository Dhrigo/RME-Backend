<?php

namespace Modules\GeneralPharmacyGuarantorMargin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyGuarantorMarginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'margin_percentage' => ['sometimes', 'numeric', 'min:0', 'max:100'],
            'effective_date' => ['nullable', 'date'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
