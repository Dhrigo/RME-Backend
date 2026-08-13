<?php

namespace Modules\MedicalRecordFingernailExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFingernailExamination\Http\Requests\StoreFingernailExaminationRequest;
use Modules\MedicalRecordFingernailExamination\Http\Requests\UpdateFingernailExaminationRequest;
use Modules\MedicalRecordFingernailExamination\Http\Resources\FingernailExaminationResource;
use Modules\MedicalRecordFingernailExamination\Models\FingernailExamination;

class FingernailExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = FingernailExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return FingernailExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreFingernailExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = FingernailExamination::create($data);

        return (new FingernailExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(FingernailExamination $record): FingernailExaminationResource
    {
        return new FingernailExaminationResource($record);
    }

    public function update(UpdateFingernailExaminationRequest $request, FingernailExamination $record): FingernailExaminationResource
    {
        $record->update($request->validated());

        return new FingernailExaminationResource($record);
    }

    public function destroy(FingernailExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
