<?php

namespace Modules\PendaftaranVisitCancellation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitCancellationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'cancelled_at' => ['nullable', 'date'],
            'reason' => ['nullable', 'string'],
        ];
    }
}
