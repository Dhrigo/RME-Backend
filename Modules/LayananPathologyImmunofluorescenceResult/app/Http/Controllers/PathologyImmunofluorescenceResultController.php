<?php

namespace Modules\LayananPathologyImmunofluorescenceResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPathologyImmunofluorescenceResult\Http\Requests\StorePathologyImmunofluorescenceResultRequest;
use Modules\LayananPathologyImmunofluorescenceResult\Http\Resources\PathologyImmunofluorescenceResultResource;
use Modules\LayananPathologyImmunofluorescenceResult\Models\PathologyImmunofluorescenceResult;

class PathologyImmunofluorescenceResultController extends Controller
{
    public function index(Request $request)
    {
        $query = PathologyImmunofluorescenceResult::query();

        return PathologyImmunofluorescenceResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyImmunofluorescenceResultRequest $request)
    {
        $data = $request->validated();

        $pa_if_result = PathologyImmunofluorescenceResult::create($data);

        return (new PathologyImmunofluorescenceResultResource($pa_if_result))->response()->setStatusCode(201);
    }

    public function show(PathologyImmunofluorescenceResult $pa_if_result): PathologyImmunofluorescenceResultResource
    {
        return new PathologyImmunofluorescenceResultResource($pa_if_result);
    }
}
