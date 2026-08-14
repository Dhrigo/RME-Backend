<?php

namespace Modules\BpjsApotek\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApotekPenyimpananObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pelayanan_id' => ['required', 'integer', 'exists:apotek_pelayanan_obats,id'],
            'jenis' => ['required', Rule::in(['non_racikan', 'racikan'])],
            'kode_obat' => ['required_if:jenis,non_racikan', 'nullable', 'string', 'max:20'],
            'nama_obat' => ['required_if:jenis,non_racikan', 'nullable', 'string', 'max:255'],
            'nama_racikan' => ['required_if:jenis,racikan', 'nullable', 'string', 'max:255'],
            'jumlah' => ['required', 'numeric', 'min:0.01'],
            'aturan_pakai' => ['nullable', 'string', 'max:100'],
            'signa1' => ['nullable', 'integer', 'min:1'],
            'signa2' => ['nullable', 'integer', 'min:1'],
            'jumlah_hari' => ['nullable', 'integer', 'min:1'],
            'harga' => ['nullable', 'numeric', 'min:0'],
            'items' => ['required_if:jenis,racikan', 'array', 'min:1'],
            'items.*.kode_obat' => ['required_with:items', 'string', 'max:20'],
            'items.*.nama_obat' => ['required_with:items', 'string', 'max:255'],
            'items.*.jumlah' => ['required_with:items', 'numeric', 'min:0.01'],
        ];
    }
}
