<?php

namespace Modules\PembayaranTransfer\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranTransfer\Http\Requests\StoreTransferRequest;
use Modules\PembayaranTransfer\Http\Requests\UpdateTransferRequest;
use Modules\PembayaranTransfer\Http\Resources\TransferResource;
use Modules\PembayaranTransfer\Models\Transfer;

class TransferController extends Controller
{
    public function index(Request $request)
    {
        $query = Transfer::query();

        if ($request->filled('payment_id')) {
            $query->where('payment_id', $request->integer('payment_id'));
        }

        return TransferResource::collection($query->latest('transferred_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTransferRequest $request)
    {
        $data = $request->validated();
        $data['transferred_at'] ??= now();
        $data['status'] = 'pending';

        $transfer = Transfer::create($data);

        return (new TransferResource($transfer))->response()->setStatusCode(201);
    }

    public function show(Transfer $bank_transfer): TransferResource
    {
        return new TransferResource($bank_transfer);
    }

    public function update(UpdateTransferRequest $request, Transfer $bank_transfer): TransferResource
    {
        if ($bank_transfer->status !== 'pending') {
            abort(422, 'Transfer ini sudah diverifikasi.');
        }

        $bank_transfer->update($request->validated());

        return new TransferResource($bank_transfer->fresh());
    }
}
