<?php

namespace Modules\PembayaranCorporateReceivable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCorporateReceivableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'guarantor_id' => ['required', 'integer', 'exists:guarantors,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
        ];
    }
}
