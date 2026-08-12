<?php

namespace Modules\InventoryItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('item')?->id;

        return [
            'code' => ['nullable', 'string', 'max:255', Rule::unique('items', 'code')->ignore($id)],
            'name' => ['sometimes', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'unit' => ['sometimes', 'string', 'max:255'],
            'brand' => ['nullable', 'string', 'max:255'],
            'is_generic' => ['sometimes', 'boolean'],
            'is_formulary' => ['sometimes', 'boolean'],
            'buy_price' => ['sometimes', 'numeric', 'min:0'],
            'sell_price' => ['sometimes', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
