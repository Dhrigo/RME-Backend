<?php

namespace Modules\InventoryStockRequestItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryStockRequestItem\Http\Requests\StoreStockRequestItemRequest;
use Modules\InventoryStockRequestItem\Http\Resources\StockRequestItemResource;
use Modules\InventoryStockRequestItem\Models\StockRequestItem;

class InventoryStockRequestItemController extends Controller
{
    public function index(Request $request)
    {
        $query = StockRequestItem::query();

        if ($request->filled('stock_request_id')) {
            $query->where('stock_request_id', $request->integer('stock_request_id'));
        }

        return StockRequestItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreStockRequestItemRequest $request)
    {
        $item = StockRequestItem::create($request->validated());

        return (new StockRequestItemResource($item))->response()->setStatusCode(201);
    }

    public function show(StockRequestItem $stock_request_item): StockRequestItemResource
    {
        return new StockRequestItemResource($stock_request_item);
    }
}
