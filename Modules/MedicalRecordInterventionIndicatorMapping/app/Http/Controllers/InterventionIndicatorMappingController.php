<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Requests\StoreInterventionIndicatorMappingRequest;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Requests\UpdateInterventionIndicatorMappingRequest;
use Modules\MedicalRecordInterventionIndicatorMapping\Http\Resources\InterventionIndicatorMappingResource;
use Modules\MedicalRecordInterventionIndicatorMapping\Models\InterventionIndicatorMapping;

class InterventionIndicatorMappingController extends Controller
{
    public function index(Request $request)
    {
        $query = InterventionIndicatorMapping::query();

        if ($request->filled('intervention_code')) {
            $query->where('intervention_code', $request->string('intervention_code'));
        }

        return InterventionIndicatorMappingResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreInterventionIndicatorMappingRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = InterventionIndicatorMapping::create($data);

        return (new InterventionIndicatorMappingResource($record))->response()->setStatusCode(201);
    }

    public function show(InterventionIndicatorMapping $record): InterventionIndicatorMappingResource
    {
        return new InterventionIndicatorMappingResource($record);
    }

    public function update(UpdateInterventionIndicatorMappingRequest $request, InterventionIndicatorMapping $record): InterventionIndicatorMappingResource
    {
        $record->update($request->validated());

        return new InterventionIndicatorMappingResource($record);
    }

    public function destroy(InterventionIndicatorMapping $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
