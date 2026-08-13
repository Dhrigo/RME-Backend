<?php

namespace Modules\LayananRadiologyOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananRadiologyOrder\Http\Requests\StoreRadiologyOrderRequest;
use Modules\LayananRadiologyOrder\Http\Requests\UpdateRadiologyOrderRequest;
use Modules\LayananRadiologyOrder\Http\Resources\RadiologyOrderResource;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;

class RadiologyOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyOrder::query();

        return RadiologyOrderResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyOrderRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'pending';
        $rad_order = RadiologyOrder::create($data);

        return (new RadiologyOrderResource($rad_order))->response()->setStatusCode(201);
    }

    public function show(RadiologyOrder $rad_order): RadiologyOrderResource
    {
        return new RadiologyOrderResource($rad_order);
    }

    public function update(UpdateRadiologyOrderRequest $request, RadiologyOrder $rad_order): RadiologyOrderResource
    {
        $rad_order->update($request->validated());

        return new RadiologyOrderResource($rad_order);
    }
}
