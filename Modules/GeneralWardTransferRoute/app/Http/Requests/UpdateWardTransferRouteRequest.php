<?php

namespace Modules\GeneralWardTransferRoute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWardTransferRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'to_ward_id' => ['sometimes', 'integer', 'exists:wards,id'],
            'requires_approval' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
