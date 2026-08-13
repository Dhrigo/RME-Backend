<?php

namespace Modules\GeneralQuantityRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralQuantityRestriction\Http\Requests\StoreQuantityRestrictionRequest;
use Modules\GeneralQuantityRestriction\Http\Requests\UpdateQuantityRestrictionRequest;
use Modules\GeneralQuantityRestriction\Http\Resources\QuantityRestrictionResource;
use Modules\GeneralQuantityRestriction\Models\QuantityRestriction;

class QuantityRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = QuantityRestriction::query();

        if ($request->filled('drug_name')) {
            $query->where('drug_name', $request->string('drug_name'));
        }

        return QuantityRestrictionResource::collection($query->orderBy('drug_name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreQuantityRestrictionRequest $request)
    {
        $restriction = QuantityRestriction::create($request->validated());

        return (new QuantityRestrictionResource($restriction))->response()->setStatusCode(201);
    }

    public function show(QuantityRestriction $quantity_restriction): QuantityRestrictionResource
    {
        return new QuantityRestrictionResource($quantity_restriction);
    }

    public function update(UpdateQuantityRestrictionRequest $request, QuantityRestriction $quantity_restriction): QuantityRestrictionResource
    {
        $quantity_restriction->update($request->validated());

        return new QuantityRestrictionResource($quantity_restriction);
    }

    public function destroy(QuantityRestriction $quantity_restriction)
    {
        $quantity_restriction->delete();

        return response()->json(null, 204);
    }
}
