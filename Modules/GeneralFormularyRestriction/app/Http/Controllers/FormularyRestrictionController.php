<?php

namespace Modules\GeneralFormularyRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralFormularyRestriction\Http\Requests\StoreFormularyRestrictionRequest;
use Modules\GeneralFormularyRestriction\Http\Requests\UpdateFormularyRestrictionRequest;
use Modules\GeneralFormularyRestriction\Http\Resources\FormularyRestrictionResource;
use Modules\GeneralFormularyRestriction\Models\FormularyRestriction;

class FormularyRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = FormularyRestriction::query();

        if ($request->filled('formulary_category')) {
            $query->where('formulary_category', $request->string('formulary_category'));
        }

        return FormularyRestrictionResource::collection($query->orderBy('drug_name')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFormularyRestrictionRequest $request)
    {
        $restriction = FormularyRestriction::create($request->validated());

        return (new FormularyRestrictionResource($restriction))->response()->setStatusCode(201);
    }

    public function show(FormularyRestriction $formulary_restriction): FormularyRestrictionResource
    {
        return new FormularyRestrictionResource($formulary_restriction);
    }

    public function update(UpdateFormularyRestrictionRequest $request, FormularyRestriction $formulary_restriction): FormularyRestrictionResource
    {
        $formulary_restriction->update($request->validated());

        return new FormularyRestrictionResource($formulary_restriction);
    }

    public function destroy(FormularyRestriction $formulary_restriction)
    {
        $formulary_restriction->delete();

        return response()->json(null, 204);
    }
}
