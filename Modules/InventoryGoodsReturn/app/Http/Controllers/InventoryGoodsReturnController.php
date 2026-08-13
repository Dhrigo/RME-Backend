<?php

namespace Modules\InventoryGoodsReturn\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryGoodsReturn\Http\Requests\StoreGoodsReturnRequest;
use Modules\InventoryGoodsReturn\Http\Requests\UpdateGoodsReturnRequest;
use Modules\InventoryGoodsReturn\Http\Resources\GoodsReturnResource;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;

class InventoryGoodsReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = GoodsReturn::query();

        if ($request->filled('supplier_id')) {
            $query->where('supplier_id', $request->integer('supplier_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return GoodsReturnResource::collection($query->latest('returned_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreGoodsReturnRequest $request)
    {
        $data = $request->validated();
        $data['return_number'] = GoodsReturn::generateReturnNumber();
        $data['returned_at'] ??= now();
        $data['returned_by'] = $request->user()->id;
        $data['status'] = 'pending';

        $return = GoodsReturn::create($data);

        return (new GoodsReturnResource($return))->response()->setStatusCode(201);
    }

    public function show(GoodsReturn $goods_return): GoodsReturnResource
    {
        return new GoodsReturnResource($goods_return);
    }

    public function update(UpdateGoodsReturnRequest $request, GoodsReturn $goods_return): GoodsReturnResource
    {
        $goods_return->update($request->validated());

        return new GoodsReturnResource($goods_return);
    }

    public function destroy(GoodsReturn $goods_return)
    {
        $goods_return->delete();

        return response()->json(null, 204);
    }
}
