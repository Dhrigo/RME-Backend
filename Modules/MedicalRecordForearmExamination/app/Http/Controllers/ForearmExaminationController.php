<?php

namespace Modules\MedicalRecordForearmExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordForearmExamination\Http\Requests\StoreForearmExaminationRequest;
use Modules\MedicalRecordForearmExamination\Http\Requests\UpdateForearmExaminationRequest;
use Modules\MedicalRecordForearmExamination\Http\Resources\ForearmExaminationResource;
use Modules\MedicalRecordForearmExamination\Models\ForearmExamination;

class ForearmExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = ForearmExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ForearmExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreForearmExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = ForearmExamination::create($data);

        return (new ForearmExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(ForearmExamination $record): ForearmExaminationResource
    {
        return new ForearmExaminationResource($record);
    }

    public function update(UpdateForearmExaminationRequest $request, ForearmExamination $record): ForearmExaminationResource
    {
        $record->update($request->validated());

        return new ForearmExaminationResource($record);
    }

    public function destroy(ForearmExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
