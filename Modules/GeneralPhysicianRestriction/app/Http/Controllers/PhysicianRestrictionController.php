<?php

namespace Modules\GeneralPhysicianRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPhysicianRestriction\Http\Requests\StorePhysicianRestrictionRequest;
use Modules\GeneralPhysicianRestriction\Http\Requests\UpdatePhysicianRestrictionRequest;
use Modules\GeneralPhysicianRestriction\Http\Resources\PhysicianRestrictionResource;
use Modules\GeneralPhysicianRestriction\Models\PhysicianRestriction;

class PhysicianRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = PhysicianRestriction::query();

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->integer('doctor_id'));
        }

        return PhysicianRestrictionResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePhysicianRestrictionRequest $request)
    {
        $restriction = PhysicianRestriction::create($request->validated());

        return (new PhysicianRestrictionResource($restriction))->response()->setStatusCode(201);
    }

    public function show(PhysicianRestriction $physician_restriction): PhysicianRestrictionResource
    {
        return new PhysicianRestrictionResource($physician_restriction);
    }

    public function update(UpdatePhysicianRestrictionRequest $request, PhysicianRestriction $physician_restriction): PhysicianRestrictionResource
    {
        $physician_restriction->update($request->validated());

        return new PhysicianRestrictionResource($physician_restriction);
    }

    public function destroy(PhysicianRestriction $physician_restriction)
    {
        $physician_restriction->delete();

        return response()->json(null, 204);
    }
}
