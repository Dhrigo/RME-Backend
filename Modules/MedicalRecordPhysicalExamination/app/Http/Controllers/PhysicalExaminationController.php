<?php

namespace Modules\MedicalRecordPhysicalExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPhysicalExamination\Http\Requests\StorePhysicalExaminationRequest;
use Modules\MedicalRecordPhysicalExamination\Http\Requests\UpdatePhysicalExaminationRequest;
use Modules\MedicalRecordPhysicalExamination\Http\Resources\PhysicalExaminationResource;
use Modules\MedicalRecordPhysicalExamination\Models\PhysicalExamination;

class PhysicalExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = PhysicalExamination::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PhysicalExaminationResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StorePhysicalExaminationRequest $request)
    {
        $data = $request->validated();
        $data['examined_at'] ??= now();

        $record = PhysicalExamination::create($data);

        return (new PhysicalExaminationResource($record))->response()->setStatusCode(201);
    }

    public function show(PhysicalExamination $record): PhysicalExaminationResource
    {
        return new PhysicalExaminationResource($record);
    }

    public function update(UpdatePhysicalExaminationRequest $request, PhysicalExamination $record): PhysicalExaminationResource
    {
        $record->update($request->validated());

        return new PhysicalExaminationResource($record);
    }

    public function destroy(PhysicalExamination $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
