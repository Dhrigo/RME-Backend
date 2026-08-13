<?php

namespace Modules\MedicalRecordLegJointExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordLegJointExamination\Http\Requests\StoreLegJointExaminationRequest;
use Modules\MedicalRecordLegJointExamination\Http\Requests\UpdateLegJointExaminationRequest;
use Modules\MedicalRecordLegJointExamination\Http\Resources\LegJointExaminationResource;
use Modules\MedicalRecordLegJointExamination\Models\LegJointExamination;

class LegJointExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = LegJointExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return LegJointExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreLegJointExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = LegJointExamination::create($data);

        return (new LegJointExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(LegJointExamination $record): LegJointExaminationResource
    {
        return new LegJointExaminationResource($record);
    }

    public function update(UpdateLegJointExaminationRequest $request, LegJointExamination $record): LegJointExaminationResource
    {
        $record->update($request->validated());

        return new LegJointExaminationResource($record);
    }

    public function destroy(LegJointExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
