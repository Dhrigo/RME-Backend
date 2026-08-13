<?php

namespace Modules\PembayaranPatientReceivable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientReceivableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['required', 'date'],
        ];
    }
}
