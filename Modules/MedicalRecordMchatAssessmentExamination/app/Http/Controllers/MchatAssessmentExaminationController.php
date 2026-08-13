<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordMchatAssessmentExamination\Http\Requests\StoreMchatAssessmentExaminationRequest;
use Modules\MedicalRecordMchatAssessmentExamination\Http\Requests\UpdateMchatAssessmentExaminationRequest;
use Modules\MedicalRecordMchatAssessmentExamination\Http\Resources\MchatAssessmentExaminationResource;
use Modules\MedicalRecordMchatAssessmentExamination\Models\MchatAssessmentExamination;

class MchatAssessmentExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = MchatAssessmentExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return MchatAssessmentExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreMchatAssessmentExaminationRequest $request)
    {
        $data = $request->validated();
        $data['total_score'] ??= 0;
        $data['risk_level'] ??= 'Low Risk';
        $data['assessed_at'] ??= now();

        $record = MchatAssessmentExamination::create($data);

        return (new MchatAssessmentExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(MchatAssessmentExamination $record): MchatAssessmentExaminationResource
    {
        return new MchatAssessmentExaminationResource($record);
    }

    public function update(UpdateMchatAssessmentExaminationRequest $request, MchatAssessmentExamination $record): MchatAssessmentExaminationResource
    {
        $record->update($request->validated());

        return new MchatAssessmentExaminationResource($record);
    }

    public function destroy(MchatAssessmentExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
