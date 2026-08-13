<?php

namespace Modules\MedicalRecordCaseManagerAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordCaseManagerAssessment\Http\Requests\StoreCaseManagerAssessmentRequest;
use Modules\MedicalRecordCaseManagerAssessment\Http\Requests\UpdateCaseManagerAssessmentRequest;
use Modules\MedicalRecordCaseManagerAssessment\Http\Resources\CaseManagerAssessmentResource;
use Modules\MedicalRecordCaseManagerAssessment\Models\CaseManagerAssessment;

class CaseManagerAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = CaseManagerAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return CaseManagerAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreCaseManagerAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = CaseManagerAssessment::create($data);

        return (new CaseManagerAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(CaseManagerAssessment $record): CaseManagerAssessmentResource
    {
        return new CaseManagerAssessmentResource($record);
    }

    public function update(UpdateCaseManagerAssessmentRequest $request, CaseManagerAssessment $record): CaseManagerAssessmentResource
    {
        $record->update($request->validated());

        return new CaseManagerAssessmentResource($record);
    }

    public function destroy(CaseManagerAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
