<?php

namespace Modules\PendaftaranVisitDateChange\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitDateChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'old_date' => ['required', 'date'],
            'new_date' => ['required', 'date', 'different:old_date'],
            'reason' => ['nullable', 'string'],
        ];
    }
}
