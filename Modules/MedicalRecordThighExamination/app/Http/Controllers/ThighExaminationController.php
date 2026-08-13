<?php

namespace Modules\MedicalRecordThighExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordThighExamination\Http\Requests\StoreThighExaminationRequest;
use Modules\MedicalRecordThighExamination\Http\Requests\UpdateThighExaminationRequest;
use Modules\MedicalRecordThighExamination\Http\Resources\ThighExaminationResource;
use Modules\MedicalRecordThighExamination\Models\ThighExamination;

class ThighExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = ThighExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ThighExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreThighExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = ThighExamination::create($data);

        return (new ThighExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(ThighExamination $record): ThighExaminationResource
    {
        return new ThighExaminationResource($record);
    }

    public function update(UpdateThighExaminationRequest $request, ThighExamination $record): ThighExaminationResource
    {
        $record->update($request->validated());

        return new ThighExaminationResource($record);
    }

    public function destroy(ThighExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
