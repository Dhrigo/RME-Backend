<?php

namespace Modules\MedicalRecordNoseExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNoseExamination\Http\Requests\StoreNoseExaminationRequest;
use Modules\MedicalRecordNoseExamination\Http\Requests\UpdateNoseExaminationRequest;
use Modules\MedicalRecordNoseExamination\Http\Resources\NoseExaminationResource;
use Modules\MedicalRecordNoseExamination\Models\NoseExamination;

class NoseExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = NoseExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return NoseExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreNoseExaminationRequest $request)
    {
        $data = $request->validated();
        $data['septum_deviation'] ??= false;
        $data['turbinate_hypertrophy'] ??= false;
        $data['polyp_present'] ??= false;
        $data['examined_at'] ??= now();

        $record = NoseExamination::create($data);

        return (new NoseExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(NoseExamination $record): NoseExaminationResource
    {
        return new NoseExaminationResource($record);
    }

    public function update(UpdateNoseExaminationRequest $request, NoseExamination $record): NoseExaminationResource
    {
        $record->update($request->validated());

        return new NoseExaminationResource($record);
    }

    public function destroy(NoseExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
