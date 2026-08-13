<?php

namespace Modules\MedicalRecordFamilyPlanningObstetrics\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFamilyPlanningObstetrics\Http\Requests\StoreFamilyPlanningObstetricsRequest;
use Modules\MedicalRecordFamilyPlanningObstetrics\Http\Requests\UpdateFamilyPlanningObstetricsRequest;
use Modules\MedicalRecordFamilyPlanningObstetrics\Http\Resources\FamilyPlanningObstetricsResource;
use Modules\MedicalRecordFamilyPlanningObstetrics\Models\FamilyPlanningObstetrics;

class FamilyPlanningObstetricsController extends Controller
{
    public function index(Request $request)
    {
        $query = FamilyPlanningObstetrics::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return FamilyPlanningObstetricsResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreFamilyPlanningObstetricsRequest $request)
    {
        $record = FamilyPlanningObstetrics::create($request->validated());

        return (new FamilyPlanningObstetricsResource($record))->response()->setStatusCode(201);
    }

    public function show(FamilyPlanningObstetrics $record): FamilyPlanningObstetricsResource
    {
        return new FamilyPlanningObstetricsResource($record);
    }

    public function update(UpdateFamilyPlanningObstetricsRequest $request, FamilyPlanningObstetrics $record): FamilyPlanningObstetricsResource
    {
        $record->update($request->validated());

        return new FamilyPlanningObstetricsResource($record);
    }

    public function destroy(FamilyPlanningObstetrics $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
