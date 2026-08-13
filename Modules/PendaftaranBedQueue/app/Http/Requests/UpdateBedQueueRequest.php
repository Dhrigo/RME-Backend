<?php

namespace Modules\PendaftaranBedQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBedQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:waiting,assigned,cancelled'],
        ];
    }
}
