<?php

namespace Modules\BpjsAntreanRs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Inbound "Ambil Antrean" payload from Mobile JKN — confirmed field shape
 * from BPJS's portal, a subset of Tambah Antrean minus the fields this
 * hospital generates (kodebooking, namapoli, namadokter, nomorantrean,
 * angkaantrean, estimasidilayani, kuota fields).
 */
class AmbilAntreanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomorkartu' => ['nullable', 'string', 'max:20'],
            'nik' => ['nullable', 'string', 'max:20'],
            'nohp' => ['nullable', 'string', 'max:20'],
            'kodepoli' => ['required', 'string', 'max:10'],
            'norm' => ['nullable', 'string', 'max:20'],
            'tanggalperiksa' => ['required', 'date'],
            'kodedokter' => ['required', 'integer'],
            'jampraktek' => ['required', 'string', 'max:30'],
            'jeniskunjungan' => ['required', 'integer', 'in:1,2,3,4'],
            'nomorreferensi' => ['nullable', 'string', 'max:50'],
        ];
    }
}
