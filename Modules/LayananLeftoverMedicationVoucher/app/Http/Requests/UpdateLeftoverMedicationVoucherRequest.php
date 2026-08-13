<?php

namespace Modules\LayananLeftoverMedicationVoucher\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLeftoverMedicationVoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'voucher_number' => ['sometimes', 'string', 'max:255', 'unique:leftover_medication_vouchers,voucher_number'],
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'prescription_id' => ['sometimes', 'integer', 'exists:prescriptions,id'],
            'status' => ['sometimes', Rule::in(['pending', 'redeemed', 'expired'])],
            'issued_at' => ['sometimes', 'date'],
            'redeemed_at' => ['sometimes', 'date'],
            'notes' => ['sometimes', 'string'],
        ];
    }
}
