<?php

namespace Modules\MedicalRecordTongueExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTongueExamination\Http\Requests\StoreTongueExaminationRequest;
use Modules\MedicalRecordTongueExamination\Http\Requests\UpdateTongueExaminationRequest;
use Modules\MedicalRecordTongueExamination\Http\Resources\TongueExaminationResource;
use Modules\MedicalRecordTongueExamination\Models\TongueExamination;

class TongueExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = TongueExamination::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TongueExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreTongueExaminationRequest $request)
    {
        $data = $request->validated();

        $data['examined_at'] ??= now();

        $record = TongueExamination::create($data);

        return (new TongueExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(TongueExamination $record): TongueExaminationResource
    {
        return new TongueExaminationResource($record);
    }

    public function update(UpdateTongueExaminationRequest $request, TongueExamination $record): TongueExaminationResource
    {
        $record->update($request->validated());

        return new TongueExaminationResource($record);
    }

    public function destroy(TongueExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
