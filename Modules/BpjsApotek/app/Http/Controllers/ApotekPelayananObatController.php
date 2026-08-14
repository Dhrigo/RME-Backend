<?php

namespace Modules\BpjsApotek\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Bpjs\Services\BpjsClient;
use Modules\BpjsApotek\Http\Resources\ApotekPelayananObatResource;
use Modules\BpjsApotek\Models\ApotekPelayananObat;

/**
 * "Pelayanan Obat" menu (Hapus/Daftar/Riwayat). List and delete operate on the
 * locally stored service record; delete is only allowed before the parent claim
 * is submitted (is_locked). Riwayat is a thin passthrough history query to BPJS.
 * Endpoint path (pelayananobat/riwayat) inferred - flagged for review.
 */
class ApotekPelayananObatController extends Controller
{
    public function __construct(private readonly BpjsClient $client)
    {
    }

    public function index(Request $request)
    {
        $query = ApotekPelayananObat::query();

        if ($request->filled('resep_id')) {
            $query->where('resep_id', $request->integer('resep_id'));
        }

        return ApotekPelayananObatResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function destroy(ApotekPelayananObat $apotek_pelayanan_obat)
    {
        if ($apotek_pelayanan_obat->is_locked) {
            return response()->json(['message' => 'Pelayanan obat sudah diklaim, tidak bisa dihapus.'], 422);
        }

        $response = $this->client->call('apotek', 'DELETE', 'pelayananobat/delete/'.$apotek_pelayanan_obat->bpjs_no_pelayanan);
        $success = ($response->metaData->code ?? null) === '200';

        if (! $success) {
            return response()->json(['message' => $response->metaData->message ?? 'Gagal menghapus pelayanan obat di BPJS.'], 422);
        }

        $apotek_pelayanan_obat->update(['deleted_at_bpjs' => now()]);
        $apotek_pelayanan_obat->delete();

        return response()->json(null, 204);
    }

    public function history(Request $request, string $no_sep): object
    {
        return $this->client->call('apotek', 'GET', 'pelayananobat/riwayat/'.$no_sep);
    }
}
