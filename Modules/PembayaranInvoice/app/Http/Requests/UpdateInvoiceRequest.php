<?php

namespace Modules\PembayaranInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('invoice')?->id;

        return [
            'invoice_number' => ['nullable', 'string', 'max:255', Rule::unique('invoices', 'invoice_number')->ignore($id)],
            'rounding_adjustment' => ['sometimes', 'numeric'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
