<?php

namespace Modules\LayananLeftoverMedicationVoucher\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeftoverMedicationVoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'voucher_number' => ['required', 'string', 'max:255', 'unique:leftover_medication_vouchers,voucher_number'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'prescription_id' => ['nullable', 'integer', 'exists:prescriptions,id'],
            'status' => ['required', Rule::in(['pending', 'redeemed', 'expired'])],
            'issued_at' => ['required', 'date'],
            'redeemed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
