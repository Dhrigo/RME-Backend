<?php

namespace Modules\LayananLabOrderItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLabOrderItem\Http\Requests\StoreLabOrderItemRequest;
use Modules\LayananLabOrderItem\Http\Resources\LabOrderItemResource;
use Modules\LayananLabOrderItem\Models\LabOrderItem;

class LabOrderItemController extends Controller
{
    public function index(Request $request)
    {
        $query = LabOrderItem::query();

        return LabOrderItemResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabOrderItemRequest $request)
    {
        $data = $request->validated();

        $lab_order_item = LabOrderItem::create($data);

        return (new LabOrderItemResource($lab_order_item))->response()->setStatusCode(201);
    }

    public function show(LabOrderItem $lab_order_item): LabOrderItemResource
    {
        return new LabOrderItemResource($lab_order_item);
    }
}
