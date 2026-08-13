<?php

namespace Modules\LayananBloodRequestItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBloodRequestItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blood_transfusion_id' => ['sometimes', 'integer', 'exists:blood_transfusions,id'],
            'blood_component' => ['sometimes', 'string', 'max:50'],
            'blood_type' => ['nullable', 'string', 'max:10'],
            'bag_quantity' => ['sometimes', 'integer'],
            'cross_match_result' => ['nullable', 'string', 'max:50'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
