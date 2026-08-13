<?php

namespace Modules\PembayaranInvoiceMerge\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceMergeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'allocated_amount' => ['sometimes', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
