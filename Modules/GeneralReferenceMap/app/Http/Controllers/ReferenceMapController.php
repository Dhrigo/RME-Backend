<?php

namespace Modules\GeneralReferenceMap\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralReferenceMap\Http\Requests\StoreReferenceMapRequest;
use Modules\GeneralReferenceMap\Http\Requests\UpdateReferenceMapRequest;
use Modules\GeneralReferenceMap\Http\Resources\ReferenceMapResource;
use Modules\GeneralReferenceMap\Models\ReferenceMap;

class ReferenceMapController extends Controller
{
    public function index(Request $request)
    {
        $query = ReferenceMap::query();

        return ReferenceMapResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReferenceMapRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] = $data['is_active'] ?? true;
        $reference_map = ReferenceMap::create($data);

        return (new ReferenceMapResource($reference_map))->response()->setStatusCode(201);
    }

    public function show(ReferenceMap $reference_map): ReferenceMapResource
    {
        return new ReferenceMapResource($reference_map);
    }

    public function update(UpdateReferenceMapRequest $request, ReferenceMap $reference_map): ReferenceMapResource
    {
        $reference_map->update($request->validated());

        return new ReferenceMapResource($reference_map);
    }

    public function destroy(ReferenceMap $reference_map)
    {
        $reference_map->delete();

        return response()->json(null, 204);
    }
}
