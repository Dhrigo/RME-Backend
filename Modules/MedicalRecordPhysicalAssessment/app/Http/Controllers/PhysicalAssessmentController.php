<?php

namespace Modules\MedicalRecordPhysicalAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPhysicalAssessment\Http\Requests\StorePhysicalAssessmentRequest;
use Modules\MedicalRecordPhysicalAssessment\Http\Requests\UpdatePhysicalAssessmentRequest;
use Modules\MedicalRecordPhysicalAssessment\Http\Resources\PhysicalAssessmentResource;
use Modules\MedicalRecordPhysicalAssessment\Models\PhysicalAssessment;

class PhysicalAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = PhysicalAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return PhysicalAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StorePhysicalAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = PhysicalAssessment::create($data);

        return (new PhysicalAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(PhysicalAssessment $record): PhysicalAssessmentResource
    {
        return new PhysicalAssessmentResource($record);
    }

    public function update(UpdatePhysicalAssessmentRequest $request, PhysicalAssessment $record): PhysicalAssessmentResource
    {
        $record->update($request->validated());

        return new PhysicalAssessmentResource($record);
    }

    public function destroy(PhysicalAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
