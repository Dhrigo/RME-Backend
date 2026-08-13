<?php

namespace Modules\MedicalRecordFunctionalAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFunctionalAssessment\Http\Requests\StoreFunctionalAssessmentRequest;
use Modules\MedicalRecordFunctionalAssessment\Http\Requests\UpdateFunctionalAssessmentRequest;
use Modules\MedicalRecordFunctionalAssessment\Http\Resources\FunctionalAssessmentResource;
use Modules\MedicalRecordFunctionalAssessment\Models\FunctionalAssessment;

class FunctionalAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = FunctionalAssessment::query();

        return FunctionalAssessmentResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFunctionalAssessmentRequest $request)
    {
        $data = $request->validated();

        $record = FunctionalAssessment::create($data);

        return (new FunctionalAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(FunctionalAssessment $record): FunctionalAssessmentResource
    {
        return new FunctionalAssessmentResource($record);
    }

    public function update(UpdateFunctionalAssessmentRequest $request, FunctionalAssessment $record): FunctionalAssessmentResource
    {
        $record->update($request->validated());

        return new FunctionalAssessmentResource($record);
    }

    public function destroy(FunctionalAssessment $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
