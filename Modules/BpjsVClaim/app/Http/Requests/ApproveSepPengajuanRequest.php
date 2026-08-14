<?php

namespace Modules\BpjsVClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApproveSepPengajuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'approved' => ['required', 'boolean'],
        ];
    }
}
