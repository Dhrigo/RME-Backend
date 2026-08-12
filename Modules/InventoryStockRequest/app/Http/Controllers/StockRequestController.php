<?php

namespace Modules\InventoryStockRequest\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Http\Requests\FulfillStockRequestRequest;
use Modules\InventoryStockRequest\Http\Requests\StoreStockRequestRequest;
use Modules\InventoryStockRequest\Http\Resources\StockRequestResource;
use Modules\InventoryStockRequest\Models\StockRequest;

class StockRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = StockRequest::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return StockRequestResource::collection($query->latest('requested_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreStockRequestRequest $request)
    {
        $data = $request->validated();
        $data['requested_at'] ??= now();
        $data['requested_by'] = $request->user()->id;
        $data['request_number'] = StockRequest::generateRequestNumber();
        $data['status'] = 'pending';

        $stockRequest = StockRequest::create($data);

        return (new StockRequestResource($stockRequest))->response()->setStatusCode(201);
    }

    public function show(StockRequest $stock_request): StockRequestResource
    {
        return new StockRequestResource($stock_request);
    }

    /**
     * Fulfilling decrements Item.stock_quantity - blocked if stock is insufficient.
     * Rejecting just marks the request, no stock movement.
     */
    public function update(FulfillStockRequestRequest $request, StockRequest $stock_request): StockRequestResource
    {
        if ($stock_request->status !== 'pending') {
            abort(422, 'Request sudah diproses.');
        }

        $data = $request->validated();

        if ($data['status'] === 'fulfilled') {
            DB::transaction(function () use ($stock_request) {
                $item = Item::whereKey($stock_request->item_id)->lockForUpdate()->first();

                if ($item->stock_quantity < $stock_request->quantity) {
                    abort(422, 'Stok tidak mencukupi.');
                }

                $item->decrement('stock_quantity', $stock_request->quantity);
                $stock_request->update(['status' => 'fulfilled', 'fulfilled_at' => now()]);
            });
        } else {
            $stock_request->update(['status' => 'rejected']);
        }

        return new StockRequestResource($stock_request->fresh());
    }
}
