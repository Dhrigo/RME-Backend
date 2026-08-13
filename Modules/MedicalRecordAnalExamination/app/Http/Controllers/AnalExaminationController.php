<?php

namespace Modules\MedicalRecordAnalExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAnalExamination\Http\Requests\StoreAnalExaminationRequest;
use Modules\MedicalRecordAnalExamination\Http\Requests\UpdateAnalExaminationRequest;
use Modules\MedicalRecordAnalExamination\Http\Resources\AnalExaminationResource;
use Modules\MedicalRecordAnalExamination\Models\AnalExamination;

class AnalExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = AnalExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AnalExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreAnalExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = AnalExamination::create($data);

        return (new AnalExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(AnalExamination $record): AnalExaminationResource
    {
        return new AnalExaminationResource($record);
    }

    public function update(UpdateAnalExaminationRequest $request, AnalExamination $record): AnalExaminationResource
    {
        $record->update($request->validated());

        return new AnalExaminationResource($record);
    }

    public function destroy(AnalExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
