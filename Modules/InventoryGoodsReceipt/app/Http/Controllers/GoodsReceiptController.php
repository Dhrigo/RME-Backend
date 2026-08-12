<?php

namespace Modules\InventoryGoodsReceipt\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\InventoryGoodsReceipt\Http\Requests\StoreGoodsReceiptRequest;
use Modules\InventoryGoodsReceipt\Http\Resources\GoodsReceiptResource;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryItem\Models\Item;

class GoodsReceiptController extends Controller
{
    public function index(Request $request)
    {
        $query = GoodsReceipt::query();

        if ($request->filled('item_id')) {
            $query->where('item_id', $request->integer('item_id'));
        }

        return GoodsReceiptResource::collection($query->latest('received_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Goods receipts are append-only - stock increases here, corrections happen
     * via a new receipt (or InventoryItem's stock adjustment), not an edit.
     */
    public function store(StoreGoodsReceiptRequest $request)
    {
        $data = $request->validated();
        $data['received_at'] ??= now();
        $data['received_by'] = $request->user()->id;
        $data['receipt_number'] = GoodsReceipt::generateReceiptNumber();

        $receipt = DB::transaction(function () use ($data) {
            $receipt = GoodsReceipt::create($data);

            Item::whereKey($data['item_id'])->increment('stock_quantity', $data['quantity']);

            return $receipt;
        });

        return (new GoodsReceiptResource($receipt))->response()->setStatusCode(201);
    }

    public function show(GoodsReceipt $goods_receipt): GoodsReceiptResource
    {
        return new GoodsReceiptResource($goods_receipt);
    }
}
