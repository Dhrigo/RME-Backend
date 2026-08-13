<?php

namespace Modules\LayananRadiologyOrderItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananRadiologyOrderItem\Http\Requests\StoreRadiologyOrderItemRequest;
use Modules\LayananRadiologyOrderItem\Http\Resources\RadiologyOrderItemResource;
use Modules\LayananRadiologyOrderItem\Models\RadiologyOrderItem;

class RadiologyOrderItemController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyOrderItem::query();

        return RadiologyOrderItemResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyOrderItemRequest $request)
    {
        $data = $request->validated();

        $rad_order_item = RadiologyOrderItem::create($data);

        return (new RadiologyOrderItemResource($rad_order_item))->response()->setStatusCode(201);
    }

    public function show(RadiologyOrderItem $rad_order_item): RadiologyOrderItemResource
    {
        return new RadiologyOrderItemResource($rad_order_item);
    }
}
