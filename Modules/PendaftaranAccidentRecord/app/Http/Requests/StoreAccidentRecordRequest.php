<?php

namespace Modules\PendaftaranAccidentRecord\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccidentRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'accident_type' => ['required', 'string', 'max:255'],
            'accident_at' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'police_report_number' => ['nullable', 'string', 'max:255'],
        ];
    }
}
