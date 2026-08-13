<?php

namespace Modules\InventoryItemPrice\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\InventoryItemPrice\Http\Requests\StoreItemPriceRequest;
use Modules\InventoryItemPrice\Http\Requests\UpdateItemPriceRequest;
use Modules\InventoryItemPrice\Http\Resources\ItemPriceResource;
use Modules\InventoryItemPrice\Models\ItemPrice;

class InventoryItemPriceController extends Controller
{
    public function index(Request $request)
    {
        $query = ItemPrice::query();

        if ($request->filled('item_id')) {
            $query->where('item_id', $request->integer('item_id'));
        }

        return ItemPriceResource::collection($query->latest('effective_date')->paginate($request->integer('per_page', 15)));
    }

    /**
     * A new active price for an item supersedes the previous active one - price history
     * is kept via is_active rather than mutating old rows.
     */
    public function store(StoreItemPriceRequest $request)
    {
        $data = $request->validated();

        $price = DB::transaction(function () use ($data) {
            ItemPrice::where('item_id', $data['item_id'])->where('is_active', true)->update(['is_active' => false]);

            return ItemPrice::create($data + ['is_active' => true]);
        });

        return (new ItemPriceResource($price))->response()->setStatusCode(201);
    }

    public function show(ItemPrice $inventoryitemprice): ItemPriceResource
    {
        return new ItemPriceResource($inventoryitemprice);
    }

    public function update(UpdateItemPriceRequest $request, ItemPrice $inventoryitemprice): ItemPriceResource
    {
        $inventoryitemprice->update($request->validated());

        return new ItemPriceResource($inventoryitemprice);
    }
}
