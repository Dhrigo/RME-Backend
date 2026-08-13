<?php

namespace Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Requests\StoreGetUpAndGoTestAssessmentRequest;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Requests\UpdateGetUpAndGoTestAssessmentRequest;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Resources\GetUpAndGoTestAssessmentResource;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Models\GetUpAndGoTestAssessment;

class GetUpAndGoTestAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = GetUpAndGoTestAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return GetUpAndGoTestAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreGetUpAndGoTestAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = GetUpAndGoTestAssessment::create($data);

        return (new GetUpAndGoTestAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(GetUpAndGoTestAssessment $record): GetUpAndGoTestAssessmentResource
    {
        return new GetUpAndGoTestAssessmentResource($record);
    }

    public function update(UpdateGetUpAndGoTestAssessmentRequest $request, GetUpAndGoTestAssessment $record): GetUpAndGoTestAssessmentResource
    {
        $record->update($request->validated());

        return new GetUpAndGoTestAssessmentResource($record);
    }

    public function destroy(GetUpAndGoTestAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
