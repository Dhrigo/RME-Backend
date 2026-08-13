<?php

namespace Modules\MedicalRecordHeadExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordHeadExamination\Http\Requests\StoreHeadExaminationRequest;
use Modules\MedicalRecordHeadExamination\Http\Requests\UpdateHeadExaminationRequest;
use Modules\MedicalRecordHeadExamination\Http\Resources\HeadExaminationResource;
use Modules\MedicalRecordHeadExamination\Models\HeadExamination;

class HeadExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = HeadExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return HeadExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreHeadExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = HeadExamination::create($data);

        return (new HeadExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(HeadExamination $record): HeadExaminationResource
    {
        return new HeadExaminationResource($record);
    }

    public function update(UpdateHeadExaminationRequest $request, HeadExamination $record): HeadExaminationResource
    {
        $record->update($request->validated());

        return new HeadExaminationResource($record);
    }

    public function destroy(HeadExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
