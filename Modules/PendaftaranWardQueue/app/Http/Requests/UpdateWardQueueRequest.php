<?php

namespace Modules\PendaftaranWardQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWardQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:waiting,called,served,skipped'],
        ];
    }
}
