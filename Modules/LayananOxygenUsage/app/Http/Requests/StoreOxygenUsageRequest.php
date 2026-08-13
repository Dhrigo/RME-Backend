<?php

namespace Modules\LayananOxygenUsage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOxygenUsageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'flow_rate_lpm' => ['required', 'numeric'],
            'method' => ['required', 'string', 'max:255'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date'],
            'recorded_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
