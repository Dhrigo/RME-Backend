<?php

namespace Modules\GeneralBirthplace\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBirthplaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:birthplaces,name'],
            'village_id' => ['nullable', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
