<?php

namespace Modules\GeneralNurseWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNurseWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nurse_id' => ['sometimes', 'exists:nurses,id'],
            'ward_id' => ['sometimes', 'exists:wards,id'],
            'shift' => ['nullable', 'string', 'max:50'],
            'assigned_at' => ['nullable', 'date'],
        ];
    }
}
