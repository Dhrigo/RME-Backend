<?php

namespace Modules\PembatalanVisitCancellation\Http\Requests;

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
            'cancelled_by' => ['required', 'integer', 'exists:users,id'],
            'reason' => ['required', 'string'],
            'cancelled_at' => ['required', 'date'],
        ];
    }
}
