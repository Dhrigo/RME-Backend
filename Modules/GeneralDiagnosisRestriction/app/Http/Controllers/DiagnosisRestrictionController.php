<?php

namespace Modules\GeneralDiagnosisRestriction\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralDiagnosisRestriction\Http\Requests\StoreDiagnosisRestrictionRequest;
use Modules\GeneralDiagnosisRestriction\Http\Requests\UpdateDiagnosisRestrictionRequest;
use Modules\GeneralDiagnosisRestriction\Http\Resources\DiagnosisRestrictionResource;
use Modules\GeneralDiagnosisRestriction\Models\DiagnosisRestriction;

class DiagnosisRestrictionController extends Controller
{
    public function index(Request $request)
    {
        $query = DiagnosisRestriction::query();

        if ($request->filled('diagnosis_code_id')) {
            $query->where('diagnosis_code_id', $request->integer('diagnosis_code_id'));
        }

        return DiagnosisRestrictionResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreDiagnosisRestrictionRequest $request)
    {
        $restriction = DiagnosisRestriction::create($request->validated());

        return (new DiagnosisRestrictionResource($restriction))->response()->setStatusCode(201);
    }

    public function show(DiagnosisRestriction $diagnosis_restriction): DiagnosisRestrictionResource
    {
        return new DiagnosisRestrictionResource($diagnosis_restriction);
    }

    public function update(UpdateDiagnosisRestrictionRequest $request, DiagnosisRestriction $diagnosis_restriction): DiagnosisRestrictionResource
    {
        $diagnosis_restriction->update($request->validated());

        return new DiagnosisRestrictionResource($diagnosis_restriction);
    }

    public function destroy(DiagnosisRestriction $diagnosis_restriction)
    {
        $diagnosis_restriction->delete();

        return response()->json(null, 204);
    }
}
