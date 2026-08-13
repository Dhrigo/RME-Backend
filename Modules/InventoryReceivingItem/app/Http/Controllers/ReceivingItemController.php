<?php

namespace Modules\InventoryReceivingItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryReceivingItem\Http\Requests\StoreReceivingItemRequest;
use Modules\InventoryReceivingItem\Http\Resources\ReceivingItemResource;
use Modules\InventoryReceivingItem\Models\ReceivingItem;

class ReceivingItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ReceivingItem::query();

        if ($request->filled('receiving_record_id')) {
            $query->where('receiving_record_id', $request->integer('receiving_record_id'));
        }

        return ReceivingItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    /**
     * Line items are append-only, same as their parent ReceivingRecord.
     */
    public function store(StoreReceivingItemRequest $request)
    {
        $item = ReceivingItem::create($request->validated());

        return (new ReceivingItemResource($item))->response()->setStatusCode(201);
    }

    public function show(ReceivingItem $receiving_item): ReceivingItemResource
    {
        return new ReceivingItemResource($receiving_item);
    }
}
