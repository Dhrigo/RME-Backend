<?php

namespace Modules\PendaftaranWardQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWardQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ward_id' => ['required', 'integer', 'exists:wards,id'],
            'queue_number' => ['required', 'integer', 'min:1'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
        ];
    }
}
