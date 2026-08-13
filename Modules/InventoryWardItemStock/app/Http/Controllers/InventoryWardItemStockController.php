<?php

namespace Modules\InventoryWardItemStock\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryWardItemStock\Http\Requests\StoreWardItemStockRequest;
use Modules\InventoryWardItemStock\Http\Requests\UpdateWardItemStockRequest;
use Modules\InventoryWardItemStock\Http\Resources\WardItemStockResource;
use Modules\InventoryWardItemStock\Models\WardItemStock;

class InventoryWardItemStockController extends Controller
{
    public function index(Request $request)
    {
        $query = WardItemStock::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        if ($request->filled('item_id')) {
            $query->where('item_id', $request->integer('item_id'));
        }

        return WardItemStockResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreWardItemStockRequest $request)
    {
        $stock = WardItemStock::create($request->validated());

        return (new WardItemStockResource($stock))->response()->setStatusCode(201);
    }

    public function show(WardItemStock $inventorywarditemstock): WardItemStockResource
    {
        return new WardItemStockResource($inventorywarditemstock);
    }

    public function update(UpdateWardItemStockRequest $request, WardItemStock $inventorywarditemstock): WardItemStockResource
    {
        $inventorywarditemstock->update($request->validated());

        return new WardItemStockResource($inventorywarditemstock);
    }

    public function destroy(WardItemStock $inventorywarditemstock)
    {
        $inventorywarditemstock->delete();

        return response()->json(null, 204);
    }
}
