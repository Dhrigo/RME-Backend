<?php

namespace Modules\MedicalRecordGraceRiskScoreAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordGraceRiskScoreAssessment\Http\Requests\StoreGraceRiskScoreAssessmentRequest;
use Modules\MedicalRecordGraceRiskScoreAssessment\Http\Requests\UpdateGraceRiskScoreAssessmentRequest;
use Modules\MedicalRecordGraceRiskScoreAssessment\Http\Resources\GraceRiskScoreAssessmentResource;
use Modules\MedicalRecordGraceRiskScoreAssessment\Models\GraceRiskScoreAssessment;

class GraceRiskScoreAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = GraceRiskScoreAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return GraceRiskScoreAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreGraceRiskScoreAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = GraceRiskScoreAssessment::create($data);

        return (new GraceRiskScoreAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(GraceRiskScoreAssessment $record): GraceRiskScoreAssessmentResource
    {
        return new GraceRiskScoreAssessmentResource($record);
    }

    public function update(UpdateGraceRiskScoreAssessmentRequest $request, GraceRiskScoreAssessment $record): GraceRiskScoreAssessmentResource
    {
        $record->update($request->validated());

        return new GraceRiskScoreAssessmentResource($record);
    }

    public function destroy(GraceRiskScoreAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
