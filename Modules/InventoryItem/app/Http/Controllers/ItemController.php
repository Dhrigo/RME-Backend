<?php

namespace Modules\InventoryItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryItem\Http\Requests\StoreItemRequest;
use Modules\InventoryItem\Http\Requests\UpdateItemRequest;
use Modules\InventoryItem\Http\Resources\ItemResource;
use Modules\InventoryItem\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->string('name').'%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        return ItemResource::collection($query->orderBy('name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());

        return (new ItemResource($item))->response()->setStatusCode(201);
    }

    public function show(Item $item): ItemResource
    {
        return new ItemResource($item);
    }

    public function update(UpdateItemRequest $request, Item $item): ItemResource
    {
        $item->update($request->validated());

        return new ItemResource($item);
    }

    /**
     * Stock is adjusted here, not via the general update() endpoint, so quantity
     * changes always go through one auditable path rather than silently riding
     * along a PUT that's really meant for updating item metadata.
     */
    public function adjustStock(Request $request, Item $item): ItemResource
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $newQuantity = $item->stock_quantity + $data['quantity'];
        abort_if($newQuantity < 0, 422, 'Stok tidak bisa jadi negatif.');

        $item->update(['stock_quantity' => $newQuantity]);

        return new ItemResource($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(null, 204);
    }
}
