<?php

namespace Modules\GeneralWardService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralWardService\Http\Requests\StoreWardServiceRequest;
use Modules\GeneralWardService\Http\Requests\UpdateWardServiceRequest;
use Modules\GeneralWardService\Http\Resources\WardServiceResource;
use Modules\GeneralWardService\Models\WardService;

class WardServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = WardService::query();

        if ($request->filled('ward_id')) {
            $query->where('ward_id', $request->integer('ward_id'));
        }

        return WardServiceResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreWardServiceRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $ward_service = WardService::create($data);

        return (new WardServiceResource($ward_service))->response()->setStatusCode(201);
    }

    public function show(WardService $ward_service): WardServiceResource
    {
        return new WardServiceResource($ward_service);
    }

    public function update(UpdateWardServiceRequest $request, WardService $ward_service): WardServiceResource
    {
        $ward_service->update($request->validated());

        return new WardServiceResource($ward_service);
    }

    public function destroy(WardService $ward_service)
    {
        $ward_service->delete();

        return response()->json(null, 204);
    }
}
