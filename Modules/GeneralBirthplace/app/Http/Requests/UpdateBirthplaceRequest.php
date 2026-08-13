<?php

namespace Modules\GeneralBirthplace\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBirthplaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255', 'unique:birthplaces,name'],
            'village_id' => ['sometimes', 'integer'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
