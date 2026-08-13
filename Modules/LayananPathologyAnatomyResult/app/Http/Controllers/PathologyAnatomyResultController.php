<?php

namespace Modules\LayananPathologyAnatomyResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPathologyAnatomyResult\Http\Requests\StorePathologyAnatomyResultRequest;
use Modules\LayananPathologyAnatomyResult\Http\Requests\UpdatePathologyAnatomyResultRequest;
use Modules\LayananPathologyAnatomyResult\Http\Resources\PathologyAnatomyResultResource;
use Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;

class PathologyAnatomyResultController extends Controller
{
    public function index(Request $request)
    {
        $query = PathologyAnatomyResult::query();

        return PathologyAnatomyResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePathologyAnatomyResultRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'pending';
        $pa_result = PathologyAnatomyResult::create($data);

        return (new PathologyAnatomyResultResource($pa_result))->response()->setStatusCode(201);
    }

    public function show(PathologyAnatomyResult $pa_result): PathologyAnatomyResultResource
    {
        return new PathologyAnatomyResultResource($pa_result);
    }

    public function update(UpdatePathologyAnatomyResultRequest $request, PathologyAnatomyResult $pa_result): PathologyAnatomyResultResource
    {
        $pa_result->update($request->validated());

        return new PathologyAnatomyResultResource($pa_result);
    }
}
