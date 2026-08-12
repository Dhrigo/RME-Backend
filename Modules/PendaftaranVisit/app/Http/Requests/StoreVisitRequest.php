<?php

namespace Modules\PendaftaranVisit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_number' => ['nullable', 'string', 'max:255', 'unique:visits,visit_number'],
            'registration_id' => ['required', 'integer', 'exists:registrations,id'],
            'attending_physician_id' => ['nullable', 'integer', 'exists:employees,id'],
            'ward_id' => ['nullable', 'integer', 'exists:wards,id'],
            'bed_id' => ['nullable', 'integer', 'exists:beds,id'],
            'admitted_at' => ['nullable', 'date'],
            'is_new_visit' => ['sometimes', 'boolean'],
            'is_deposit' => ['sometimes', 'boolean'],
            'deposit_class_id' => ['nullable', 'integer'],
            'status' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
