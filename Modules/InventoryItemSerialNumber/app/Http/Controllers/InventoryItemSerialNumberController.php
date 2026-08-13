<?php

namespace Modules\InventoryItemSerialNumber\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryItemSerialNumber\Http\Requests\StoreItemSerialNumberRequest;
use Modules\InventoryItemSerialNumber\Http\Requests\UpdateItemSerialNumberRequest;
use Modules\InventoryItemSerialNumber\Http\Resources\ItemSerialNumberResource;
use Modules\InventoryItemSerialNumber\Models\ItemSerialNumber;

class InventoryItemSerialNumberController extends Controller
{
    public function index(Request $request)
    {
        $query = ItemSerialNumber::query();

        if ($request->filled('ward_item_stock_id')) {
            $query->where('ward_item_stock_id', $request->integer('ward_item_stock_id'));
        }

        return ItemSerialNumberResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreItemSerialNumberRequest $request)
    {
        $serial = ItemSerialNumber::create($request->validated());

        return (new ItemSerialNumberResource($serial))->response()->setStatusCode(201);
    }

    public function show(ItemSerialNumber $inventoryitemserialnumber): ItemSerialNumberResource
    {
        return new ItemSerialNumberResource($inventoryitemserialnumber);
    }

    public function update(UpdateItemSerialNumberRequest $request, ItemSerialNumber $inventoryitemserialnumber): ItemSerialNumberResource
    {
        $inventoryitemserialnumber->update($request->validated());

        return new ItemSerialNumberResource($inventoryitemserialnumber);
    }

    public function destroy(ItemSerialNumber $inventoryitemserialnumber)
    {
        $inventoryitemserialnumber->delete();

        return response()->json(null, 204);
    }
}
