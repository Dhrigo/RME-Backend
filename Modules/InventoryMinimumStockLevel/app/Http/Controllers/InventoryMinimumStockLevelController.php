<?php

namespace Modules\InventoryMinimumStockLevel\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryMinimumStockLevel\Http\Requests\StoreMinimumStockLevelRequest;
use Modules\InventoryMinimumStockLevel\Http\Requests\UpdateMinimumStockLevelRequest;
use Modules\InventoryMinimumStockLevel\Http\Resources\MinimumStockLevelResource;
use Modules\InventoryMinimumStockLevel\Models\MinimumStockLevel;

class InventoryMinimumStockLevelController extends Controller
{
    public function index(Request $request)
    {
        $query = MinimumStockLevel::query();

        if ($request->filled('item_id')) {
            $query->where('item_id', $request->integer('item_id'));
        }

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return MinimumStockLevelResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMinimumStockLevelRequest $request)
    {
        $level = MinimumStockLevel::create($request->validated());

        return (new MinimumStockLevelResource($level))->response()->setStatusCode(201);
    }

    public function show(MinimumStockLevel $inventoryminimumstocklevel): MinimumStockLevelResource
    {
        return new MinimumStockLevelResource($inventoryminimumstocklevel);
    }

    public function update(UpdateMinimumStockLevelRequest $request, MinimumStockLevel $inventoryminimumstocklevel): MinimumStockLevelResource
    {
        $inventoryminimumstocklevel->update($request->validated());

        return new MinimumStockLevelResource($inventoryminimumstocklevel);
    }

    public function destroy(MinimumStockLevel $inventoryminimumstocklevel)
    {
        $inventoryminimumstocklevel->delete();

        return response()->json(null, 204);
    }
}
