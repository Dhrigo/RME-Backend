<?php

namespace Modules\MedicalRecordChestExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordChestExamination\Http\Requests\StoreChestExaminationRequest;
use Modules\MedicalRecordChestExamination\Http\Requests\UpdateChestExaminationRequest;
use Modules\MedicalRecordChestExamination\Http\Resources\ChestExaminationResource;
use Modules\MedicalRecordChestExamination\Models\ChestExamination;

class ChestExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = ChestExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return ChestExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreChestExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = ChestExamination::create($data);

        return (new ChestExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(ChestExamination $record): ChestExaminationResource
    {
        return new ChestExaminationResource($record);
    }

    public function update(UpdateChestExaminationRequest $request, ChestExamination $record): ChestExaminationResource
    {
        $record->update($request->validated());

        return new ChestExaminationResource($record);
    }

    public function destroy(ChestExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
