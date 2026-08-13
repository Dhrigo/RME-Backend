<?php

namespace Modules\PendaftaranServiceHandover\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceHandoverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'handed_over_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
