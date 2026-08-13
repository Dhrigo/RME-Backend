<?php

namespace Modules\InventoryGoodsReceiptCancellation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryGoodsReceiptCancellation\Http\Requests\StoreGoodsReceiptCancellationRequest;
use Modules\InventoryGoodsReceiptCancellation\Http\Resources\GoodsReceiptCancellationResource;
use Modules\InventoryGoodsReceiptCancellation\Models\GoodsReceiptCancellation;

class InventoryGoodsReceiptCancellationController extends Controller
{
    public function index(Request $request)
    {
        $query = GoodsReceiptCancellation::query();

        if ($request->filled('goods_receipt_id')) {
            $query->where('goods_receipt_id', $request->integer('goods_receipt_id'));
        }

        return GoodsReceiptCancellationResource::collection($query->latest('cancelled_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Cancellation records are append-only, same as PendaftaranVisitCancellation - a
     * cancelled receipt is corrected by a new record, not by editing history.
     */
    public function store(StoreGoodsReceiptCancellationRequest $request)
    {
        $data = $request->validated();
        $data['cancellation_number'] = GoodsReceiptCancellation::generateCancellationNumber();
        $data['cancelled_at'] ??= now();
        $data['cancelled_by'] = $request->user()->id;

        $cancellation = GoodsReceiptCancellation::create($data);

        return (new GoodsReceiptCancellationResource($cancellation))->response()->setStatusCode(201);
    }

    public function show(GoodsReceiptCancellation $cancellation): GoodsReceiptCancellationResource
    {
        return new GoodsReceiptCancellationResource($cancellation);
    }
}
