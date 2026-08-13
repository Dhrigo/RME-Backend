<?php

namespace Modules\GeneralPrescriptionOriginUnitRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralPrescriptionOriginUnitRestriction\Http\Requests\StorePrescriptionOriginUnitRestrictionRequest;
use Modules\GeneralPrescriptionOriginUnitRestriction\Http\Requests\UpdatePrescriptionOriginUnitRestrictionRequest;
use Modules\GeneralPrescriptionOriginUnitRestriction\Http\Resources\PrescriptionOriginUnitRestrictionResource;
use Modules\GeneralPrescriptionOriginUnitRestriction\Models\PrescriptionOriginUnitRestriction;

class PrescriptionOriginUnitRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionOriginUnitRestriction::query();

        return PrescriptionOriginUnitRestrictionResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionOriginUnitRestrictionRequest $request)
    {
        $data = $request->validated();
        $data['is_allowed'] = $data['is_allowed'] ?? true;
        $data['is_active'] = $data['is_active'] ?? true;
        $origin_unit_restriction = PrescriptionOriginUnitRestriction::create($data);

        return (new PrescriptionOriginUnitRestrictionResource($origin_unit_restriction))->response()->setStatusCode(201);
    }

    public function show(PrescriptionOriginUnitRestriction $origin_unit_restriction): PrescriptionOriginUnitRestrictionResource
    {
        return new PrescriptionOriginUnitRestrictionResource($origin_unit_restriction);
    }

    public function update(UpdatePrescriptionOriginUnitRestrictionRequest $request, PrescriptionOriginUnitRestriction $origin_unit_restriction): PrescriptionOriginUnitRestrictionResource
    {
        $origin_unit_restriction->update($request->validated());

        return new PrescriptionOriginUnitRestrictionResource($origin_unit_restriction);
    }

    public function destroy(PrescriptionOriginUnitRestriction $origin_unit_restriction)
    {
        $origin_unit_restriction->delete();

        return response()->json(null, 204);
    }
}
