<?php

namespace Modules\GeneralService\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralService\Http\Requests\StoreServiceRequest;
use Modules\GeneralService\Http\Requests\UpdateServiceRequest;
use Modules\GeneralService\Http\Resources\ServiceResource;
use Modules\GeneralService\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query()->with('tariffs');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->string('name').'%');
        }

        return ServiceResource::collection($query->orderBy('name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());

        return (new ServiceResource($service))->response()->setStatusCode(201);
    }

    public function show(Service $service): ServiceResource
    {
        return new ServiceResource($service->load('tariffs'));
    }

    public function update(UpdateServiceRequest $request, Service $service): ServiceResource
    {
        $service->update($request->validated());

        return new ServiceResource($service);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json(null, 204);
    }
}
