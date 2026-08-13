<?php

namespace Modules\GeneralNurseWardAssignment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNurseWardAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nurse_id' => ['required', 'exists:nurses,id'],
            'ward_id' => ['required', 'exists:wards,id'],
            'shift' => ['nullable', 'string', 'max:50'],
            'assigned_at' => ['nullable', 'date'],
        ];
    }
}
