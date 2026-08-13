<?php

namespace Modules\MedicalRecordNursingIndicator\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingIndicator\Http\Requests\StoreNursingIndicatorRequest;
use Modules\MedicalRecordNursingIndicator\Http\Requests\UpdateNursingIndicatorRequest;
use Modules\MedicalRecordNursingIndicator\Http\Resources\NursingIndicatorResource;
use Modules\MedicalRecordNursingIndicator\Models\NursingIndicator;

class NursingIndicatorController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingIndicator::query();

        return NursingIndicatorResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingIndicatorRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = NursingIndicator::create($data);

        return (new NursingIndicatorResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingIndicator $record): NursingIndicatorResource
    {
        return new NursingIndicatorResource($record);
    }

    public function update(UpdateNursingIndicatorRequest $request, NursingIndicator $record): NursingIndicatorResource
    {
        $record->update($request->validated());

        return new NursingIndicatorResource($record);
    }

    public function destroy(NursingIndicator $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
