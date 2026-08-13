<?php

namespace Modules\PendaftaranReservation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'reserved_at' => ['required', 'date'],
            'scheduled_at' => ['required', 'date', 'after_or_equal:reserved_at'],
            'status' => ['nullable', 'string', 'in:pending,confirmed,cancelled,completed'],
        ];
    }
}
