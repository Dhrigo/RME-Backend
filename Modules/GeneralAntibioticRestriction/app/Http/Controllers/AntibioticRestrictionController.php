<?php

namespace Modules\GeneralAntibioticRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralAntibioticRestriction\Http\Requests\StoreAntibioticRestrictionRequest;
use Modules\GeneralAntibioticRestriction\Http\Requests\UpdateAntibioticRestrictionRequest;
use Modules\GeneralAntibioticRestriction\Http\Resources\AntibioticRestrictionResource;
use Modules\GeneralAntibioticRestriction\Models\AntibioticRestriction;

class AntibioticRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = AntibioticRestriction::query();

        if ($request->filled('aware_category')) {
            $query->where('aware_category', $request->string('aware_category'));
        }

        return AntibioticRestrictionResource::collection($query->orderBy('antibiotic_name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntibioticRestrictionRequest $request)
    {
        $restriction = AntibioticRestriction::create($request->validated());

        return (new AntibioticRestrictionResource($restriction))->response()->setStatusCode(201);
    }

    public function show(AntibioticRestriction $antibiotic_restriction): AntibioticRestrictionResource
    {
        return new AntibioticRestrictionResource($antibiotic_restriction);
    }

    public function update(UpdateAntibioticRestrictionRequest $request, AntibioticRestriction $antibiotic_restriction): AntibioticRestrictionResource
    {
        $antibiotic_restriction->update($request->validated());

        return new AntibioticRestrictionResource($antibiotic_restriction);
    }

    public function destroy(AntibioticRestriction $antibiotic_restriction)
    {
        $antibiotic_restriction->delete();

        return response()->json(null, 204);
    }
}
