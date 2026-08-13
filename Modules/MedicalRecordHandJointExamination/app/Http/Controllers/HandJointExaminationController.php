<?php

namespace Modules\MedicalRecordHandJointExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHandJointExamination\Http\Requests\StoreHandJointExaminationRequest;
use Modules\MedicalRecordHandJointExamination\Http\Requests\UpdateHandJointExaminationRequest;
use Modules\MedicalRecordHandJointExamination\Http\Resources\HandJointExaminationResource;
use Modules\MedicalRecordHandJointExamination\Models\HandJointExamination;

class HandJointExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = HandJointExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return HandJointExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreHandJointExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = HandJointExamination::create($data);

        return (new HandJointExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(HandJointExamination $record): HandJointExaminationResource
    {
        return new HandJointExaminationResource($record);
    }

    public function update(UpdateHandJointExaminationRequest $request, HandJointExamination $record): HandJointExaminationResource
    {
        $record->update($request->validated());

        return new HandJointExaminationResource($record);
    }

    public function destroy(HandJointExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
