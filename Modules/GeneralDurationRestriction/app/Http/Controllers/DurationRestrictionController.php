<?php

namespace Modules\GeneralDurationRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralDurationRestriction\Http\Requests\StoreDurationRestrictionRequest;
use Modules\GeneralDurationRestriction\Http\Requests\UpdateDurationRestrictionRequest;
use Modules\GeneralDurationRestriction\Http\Resources\DurationRestrictionResource;
use Modules\GeneralDurationRestriction\Models\DurationRestriction;

class DurationRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = DurationRestriction::query();

        if ($request->filled('antibiotic_name')) {
            $query->where('antibiotic_name', $request->string('antibiotic_name'));
        }

        return DurationRestrictionResource::collection($query->orderBy('antibiotic_name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDurationRestrictionRequest $request)
    {
        $restriction = DurationRestriction::create($request->validated());

        return (new DurationRestrictionResource($restriction))->response()->setStatusCode(201);
    }

    public function show(DurationRestriction $duration_restriction): DurationRestrictionResource
    {
        return new DurationRestrictionResource($duration_restriction);
    }

    public function update(UpdateDurationRestrictionRequest $request, DurationRestriction $duration_restriction): DurationRestrictionResource
    {
        $duration_restriction->update($request->validated());

        return new DurationRestrictionResource($duration_restriction);
    }

    public function destroy(DurationRestriction $duration_restriction)
    {
        $duration_restriction->delete();

        return response()->json(null, 204);
    }
}
