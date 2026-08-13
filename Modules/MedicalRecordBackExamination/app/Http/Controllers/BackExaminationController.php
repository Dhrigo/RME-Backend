<?php

namespace Modules\MedicalRecordBackExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBackExamination\Http\Requests\StoreBackExaminationRequest;
use Modules\MedicalRecordBackExamination\Http\Requests\UpdateBackExaminationRequest;
use Modules\MedicalRecordBackExamination\Http\Resources\BackExaminationResource;
use Modules\MedicalRecordBackExamination\Models\BackExamination;

class BackExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = BackExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BackExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreBackExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = BackExamination::create($data);

        return (new BackExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(BackExamination $record): BackExaminationResource
    {
        return new BackExaminationResource($record);
    }

    public function update(UpdateBackExaminationRequest $request, BackExamination $record): BackExaminationResource
    {
        $record->update($request->validated());

        return new BackExaminationResource($record);
    }

    public function destroy(BackExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
