<?php

namespace Modules\MedicalRecordEegExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEegExamination\Http\Requests\StoreEegExaminationRequest;
use Modules\MedicalRecordEegExamination\Http\Requests\UpdateEegExaminationRequest;
use Modules\MedicalRecordEegExamination\Http\Resources\EegExaminationResource;
use Modules\MedicalRecordEegExamination\Models\EegExamination;

class EegExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = EegExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return EegExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreEegExaminationRequest $request)
    {
        $data = $request->validated();
        $data['epileptiform_discharges'] ??= false;
        $data['examined_at'] ??= now();

        $record = EegExamination::create($data);

        return (new EegExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(EegExamination $record): EegExaminationResource
    {
        return new EegExaminationResource($record);
    }

    public function update(UpdateEegExaminationRequest $request, EegExamination $record): EegExaminationResource
    {
        $record->update($request->validated());

        return new EegExaminationResource($record);
    }

    public function destroy(EegExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
