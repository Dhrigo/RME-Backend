<?php

namespace Modules\MedicalRecordNeckExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNeckExamination\Http\Requests\StoreNeckExaminationRequest;
use Modules\MedicalRecordNeckExamination\Http\Requests\UpdateNeckExaminationRequest;
use Modules\MedicalRecordNeckExamination\Http\Resources\NeckExaminationResource;
use Modules\MedicalRecordNeckExamination\Models\NeckExamination;

class NeckExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = NeckExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return NeckExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreNeckExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = NeckExamination::create($data);

        return (new NeckExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(NeckExamination $record): NeckExaminationResource
    {
        return new NeckExaminationResource($record);
    }

    public function update(UpdateNeckExaminationRequest $request, NeckExamination $record): NeckExaminationResource
    {
        $record->update($request->validated());

        return new NeckExaminationResource($record);
    }

    public function destroy(NeckExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
