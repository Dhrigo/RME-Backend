<?php

namespace Modules\InventoryGoodsReturnItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryGoodsReturnItem\Http\Requests\StoreGoodsReturnItemRequest;
use Modules\InventoryGoodsReturnItem\Http\Resources\GoodsReturnItemResource;
use Modules\InventoryGoodsReturnItem\Models\GoodsReturnItem;

class InventoryGoodsReturnItemController extends Controller
{
    public function index(Request $request)
    {
        $query = GoodsReturnItem::query();

        if ($request->filled('goods_return_id')) {
            $query->where('goods_return_id', $request->integer('goods_return_id'));
        }

        return GoodsReturnItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    /**
     * Line items are append-only, same as InventoryReceivingItem - the return header
     * (InventoryGoodsReturn) carries the status workflow.
     */
    public function store(StoreGoodsReturnItemRequest $request)
    {
        $item = GoodsReturnItem::create($request->validated());

        return (new GoodsReturnItemResource($item))->response()->setStatusCode(201);
    }

    public function show(GoodsReturnItem $goods_return_item): GoodsReturnItemResource
    {
        return new GoodsReturnItemResource($goods_return_item);
    }
}
