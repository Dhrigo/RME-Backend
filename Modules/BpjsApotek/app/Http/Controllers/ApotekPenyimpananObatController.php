<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsApotek\Http\Requests\StoreApotekPenyimpananObatRequest;
use Modules\BpjsApotek\Http\Resources\ApotekPenyimpananObatResource;
use Modules\BpjsApotek\Models\ApotekPenyimpananObat;

/**
 * "Obat / Penyimpanan Obat" menu - submission of dispensed-drug records
 * (Non Racikan / Racikan) plus the separate "Update Stok Obat" push.
 * Endpoint paths (penyimpananobat/insert, penyimpananobat/updatestok) are
 * inferred from BPJS's documented Apotek naming convention - flagged for review.
 */
class ApotekPenyimpananObatController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function store(StoreApotekPenyimpananObatRequest $request)
    {
        $data = $request->validated();
        $items = $data['items'] ?? [];
        unset($data['items']);
        $data['status'] = 'draft';

        $penyimpanan = ApotekPenyimpananObat::create($data);

        foreach ($items as $item) {
            $penyimpanan->items()->create($item);
        }

        $payload = $penyimpanan->jenis === 'racikan'
            ? [
                'namaRacikan' => $penyimpanan->nama_racikan,
                'jumlah' => (float) $penyimpanan->jumlah,
                'aturanPakai' => $penyimpanan->aturan_pakai,
                'jumlahHari' => $penyimpanan->jumlah_hari,
                'harga' => (float) $penyimpanan->harga,
                'items' => $penyimpanan->items->map(fn ($item) => [
                    'kodeObat' => $item->kode_obat,
                    'namaObat' => $item->nama_obat,
                    'jumlah' => (float) $item->jumlah,
                ])->all(),
            ]
            : [
                'kodeObat' => $penyimpanan->kode_obat,
                'namaObat' => $penyimpanan->nama_obat,
                'jumlah' => (float) $penyimpanan->jumlah,
                'aturanPakai' => $penyimpanan->aturan_pakai,
                'jumlahHari' => $penyimpanan->jumlah_hari,
                'harga' => (float) $penyimpanan->harga,
            ];

        $response = $this->client->call('apotek', 'POST', 'penyimpananobat/insert', $payload);
        $success = ($response->metaData->code ?? null) === '200';

        $penyimpanan->update([
            'bpjs_no_pelayanan_obat' => $success ? ($response->response->noPelayananObat ?? null) : null,
            'status' => $success ? 'success' : 'failed',
            'bpjs_message' => $response->metaData->message ?? null,
            'submitted_at' => now(),
        ]);

        return (new ApotekPenyimpananObatResource($penyimpanan->fresh('items')))->response()->setStatusCode(201);
    }

    public function show(ApotekPenyimpananObat $apotek_penyimpanan_obat): ApotekPenyimpananObatResource
    {
        return new ApotekPenyimpananObatResource($apotek_penyimpanan_obat->load('items'));
    }

    public function updateStok(Request $request): object
    {
        $request->validate([
            'obat' => ['required', 'array', 'min:1'],
            'obat.*.kode_obat' => ['required', 'string'],
            'obat.*.stok' => ['required', 'numeric', 'min:0'],
        ]);

        $payload = [
            'obat' => collect($request->input('obat'))->map(fn ($row) => [
                'kodeObat' => $row['kode_obat'],
                'stok' => (float) $row['stok'],
            ])->all(),
        ];

        return $this->client->call('apotek', 'POST', 'penyimpananobat/updatestok', $payload);
    }
}
