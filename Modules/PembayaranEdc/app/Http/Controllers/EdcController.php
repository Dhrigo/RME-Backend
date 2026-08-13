<?php

namespace Modules\PembayaranEdc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranEdc\Http\Requests\StoreEdcRequest;
use Modules\PembayaranEdc\Http\Requests\UpdateEdcRequest;
use Modules\PembayaranEdc\Http\Resources\EdcResource;
use Modules\PembayaranEdc\Models\Edc;

class EdcController extends Controller
{
    public function index(Request $request)
    {
        $query = Edc::query();

        if ($request->filled('payment_id')) {
            $query->where('payment_id', $request->integer('payment_id'));
        }

        return EdcResource::collection($query->latest('transaction_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEdcRequest $request)
    {
        $data = $request->validated();
        $data['transaction_at'] ??= now();
        $data['status'] = 'pending';

        $edc = Edc::create($data);

        return (new EdcResource($edc))->response()->setStatusCode(201);
    }

    public function show(Edc $edc_transaction): EdcResource
    {
        return new EdcResource($edc_transaction);
    }

    public function update(UpdateEdcRequest $request, Edc $edc_transaction): EdcResource
    {
        if ($edc_transaction->status !== 'pending') {
            abort(422, 'Transaksi EDC ini sudah diproses.');
        }

        $edc_transaction->update($request->validated());

        return new EdcResource($edc_transaction->fresh());
    }
}
