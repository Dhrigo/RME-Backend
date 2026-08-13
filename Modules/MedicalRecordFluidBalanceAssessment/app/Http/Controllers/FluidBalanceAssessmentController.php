<?php

namespace Modules\MedicalRecordFluidBalanceAssessment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFluidBalanceAssessment\Http\Requests\StoreFluidBalanceAssessmentRequest;
use Modules\MedicalRecordFluidBalanceAssessment\Http\Requests\UpdateFluidBalanceAssessmentRequest;
use Modules\MedicalRecordFluidBalanceAssessment\Http\Resources\FluidBalanceAssessmentResource;
use Modules\MedicalRecordFluidBalanceAssessment\Models\FluidBalanceAssessment;

class FluidBalanceAssessmentController extends Controller
{
    public function index(Request $request)
    {
        $query = FluidBalanceAssessment::query();


        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return FluidBalanceAssessmentResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreFluidBalanceAssessmentRequest $request)
    {
        $data = $request->validated();

        $data['assessed_at'] ??= now();

        $record = FluidBalanceAssessment::create($data);

        return (new FluidBalanceAssessmentResource($record))->response()->setStatusCode(201);
    }

    public function show(FluidBalanceAssessment $record): FluidBalanceAssessmentResource
    {
        return new FluidBalanceAssessmentResource($record);
    }

    public function update(UpdateFluidBalanceAssessmentRequest $request, FluidBalanceAssessment $record): FluidBalanceAssessmentResource
    {
        $record->update($request->validated());

        return new FluidBalanceAssessmentResource($record);
    }

    public function destroy(FluidBalanceAssessment $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
