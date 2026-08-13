<?php

namespace Modules\InventoryShipmentItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryShipmentItem\Http\Requests\StoreShipmentItemRequest;
use Modules\InventoryShipmentItem\Http\Resources\ShipmentItemResource;
use Modules\InventoryShipmentItem\Models\ShipmentItem;

class ShipmentItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ShipmentItem::query();

        if ($request->filled('shipment_id')) {
            $query->where('shipment_id', $request->integer('shipment_id'));
        }

        return ShipmentItemResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreShipmentItemRequest $request)
    {
        $item = ShipmentItem::create($request->validated());

        return (new ShipmentItemResource($item))->response()->setStatusCode(201);
    }

    public function show(ShipmentItem $shipment_item): ShipmentItemResource
    {
        return new ShipmentItemResource($shipment_item);
    }
}
