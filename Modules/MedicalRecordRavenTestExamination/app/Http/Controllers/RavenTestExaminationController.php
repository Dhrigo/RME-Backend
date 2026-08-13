<?php

namespace Modules\MedicalRecordRavenTestExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRavenTestExamination\Http\Requests\StoreRavenTestExaminationRequest;
use Modules\MedicalRecordRavenTestExamination\Http\Requests\UpdateRavenTestExaminationRequest;
use Modules\MedicalRecordRavenTestExamination\Http\Resources\RavenTestExaminationResource;
use Modules\MedicalRecordRavenTestExamination\Models\RavenTestExamination;

class RavenTestExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = RavenTestExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return RavenTestExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreRavenTestExaminationRequest $request)
    {
        $data = $request->validated();

        $data['tested_at'] ??= now();

        $record = RavenTestExamination::create($data);

        return (new RavenTestExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(RavenTestExamination $record): RavenTestExaminationResource
    {
        return new RavenTestExaminationResource($record);
    }

    public function update(UpdateRavenTestExaminationRequest $request, RavenTestExamination $record): RavenTestExaminationResource
    {
        $record->update($request->validated());

        return new RavenTestExaminationResource($record);
    }

    public function destroy(RavenTestExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
