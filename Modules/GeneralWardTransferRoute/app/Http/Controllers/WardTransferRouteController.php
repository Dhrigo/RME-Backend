<?php

namespace Modules\GeneralWardTransferRoute\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralWardTransferRoute\Http\Requests\StoreWardTransferRouteRequest;
use Modules\GeneralWardTransferRoute\Http\Requests\UpdateWardTransferRouteRequest;
use Modules\GeneralWardTransferRoute\Http\Resources\WardTransferRouteResource;
use Modules\GeneralWardTransferRoute\Models\WardTransferRoute;

class WardTransferRouteController extends Controller
{
    public function index(Request $request)
    {
        $query = WardTransferRoute::query();

        return WardTransferRouteResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreWardTransferRouteRequest $request)
    {
        $data = $request->validated();
        $data['requires_approval'] = $data['requires_approval'] ?? false;
        $data['is_active'] = $data['is_active'] ?? true;
        $transfer_route = WardTransferRoute::create($data);

        return (new WardTransferRouteResource($transfer_route))->response()->setStatusCode(201);
    }

    public function show(WardTransferRoute $transfer_route): WardTransferRouteResource
    {
        return new WardTransferRouteResource($transfer_route);
    }

    public function update(UpdateWardTransferRouteRequest $request, WardTransferRoute $transfer_route): WardTransferRouteResource
    {
        $transfer_route->update($request->validated());

        return new WardTransferRouteResource($transfer_route);
    }

    public function destroy(WardTransferRoute $transfer_route)
    {
        $transfer_route->delete();

        return response()->json(null, 204);
    }
}
