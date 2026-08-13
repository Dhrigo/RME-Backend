<?php

namespace Modules\PembayaranClaimInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranClaimInvoice\Models\ClaimInvoice;

class UpdateClaimInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('claim_invoice')?->id;

        return [
            'claim_number' => ['nullable', 'string', 'max:255', Rule::unique('claim_invoices', 'claim_number')->ignore($id)],
            'verified_amount' => ['nullable', 'numeric', 'min:0'],
            'status' => ['sometimes', Rule::in(ClaimInvoice::STATUSES)],
            'rejection_reason' => ['nullable', 'string'],
        ];
    }
}
