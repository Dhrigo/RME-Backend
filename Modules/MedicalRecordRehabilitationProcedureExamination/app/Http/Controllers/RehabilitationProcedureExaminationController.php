<?php

namespace Modules\MedicalRecordRehabilitationProcedureExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRehabilitationProcedureExamination\Http\Requests\StoreRehabilitationProcedureExaminationRequest;
use Modules\MedicalRecordRehabilitationProcedureExamination\Http\Requests\UpdateRehabilitationProcedureExaminationRequest;
use Modules\MedicalRecordRehabilitationProcedureExamination\Http\Resources\RehabilitationProcedureExaminationResource;
use Modules\MedicalRecordRehabilitationProcedureExamination\Models\RehabilitationProcedureExamination;

class RehabilitationProcedureExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = RehabilitationProcedureExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return RehabilitationProcedureExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreRehabilitationProcedureExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = RehabilitationProcedureExamination::create($data);

        return (new RehabilitationProcedureExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(RehabilitationProcedureExamination $record): RehabilitationProcedureExaminationResource
    {
        return new RehabilitationProcedureExaminationResource($record);
    }

    public function update(UpdateRehabilitationProcedureExaminationRequest $request, RehabilitationProcedureExamination $record): RehabilitationProcedureExaminationResource
    {
        $record->update($request->validated());

        return new RehabilitationProcedureExaminationResource($record);
    }

    public function destroy(RehabilitationProcedureExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
