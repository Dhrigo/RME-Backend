<?php

namespace Modules\InventoryStockOpnameItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryStockOpnameItem\Http\Requests\StoreStockOpnameItemRequest;
use Modules\InventoryStockOpnameItem\Http\Resources\StockOpnameItemResource;
use Modules\InventoryStockOpnameItem\Models\StockOpnameItem;

class InventoryStockOpnameItemController extends Controller
{
    public function index(Request $request)
    {
        $query = StockOpnameItem::query();

        if ($request->filled('stock_opname_id')) {
            $query->where('stock_opname_id', $request->integer('stock_opname_id'));
        }

        return StockOpnameItemResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreStockOpnameItemRequest $request)
    {
        $data = $request->validated();
        $data['difference'] = $data['physical_quantity'] - $data['system_quantity'];

        $item = StockOpnameItem::create($data);

        return (new StockOpnameItemResource($item))->response()->setStatusCode(201);
    }

    public function show(StockOpnameItem $inventorystockopnameitem): StockOpnameItemResource
    {
        return new StockOpnameItemResource($inventorystockopnameitem);
    }
}
