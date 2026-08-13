<?php

namespace Modules\LayananOxygenUsage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOxygenUsageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'flow_rate_lpm' => ['sometimes', 'numeric'],
            'method' => ['sometimes', 'string', 'max:255'],
            'started_at' => ['sometimes', 'date'],
            'ended_at' => ['sometimes', 'date'],
            'recorded_by' => ['sometimes', 'integer', 'exists:users,id'],
        ];
    }
}
