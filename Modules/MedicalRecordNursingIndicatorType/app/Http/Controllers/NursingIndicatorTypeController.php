<?php

namespace Modules\MedicalRecordNursingIndicatorType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingIndicatorType\Http\Requests\StoreNursingIndicatorTypeRequest;
use Modules\MedicalRecordNursingIndicatorType\Http\Requests\UpdateNursingIndicatorTypeRequest;
use Modules\MedicalRecordNursingIndicatorType\Http\Resources\NursingIndicatorTypeResource;
use Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType;

class NursingIndicatorTypeController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingIndicatorType::query();

        return NursingIndicatorTypeResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingIndicatorTypeRequest $request)
    {
        $data = $request->validated();
        $data['is_active'] ??= true;

        $record = NursingIndicatorType::create($data);

        return (new NursingIndicatorTypeResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingIndicatorType $record): NursingIndicatorTypeResource
    {
        return new NursingIndicatorTypeResource($record);
    }

    public function update(UpdateNursingIndicatorTypeRequest $request, NursingIndicatorType $record): NursingIndicatorTypeResource
    {
        $record->update($request->validated());

        return new NursingIndicatorTypeResource($record);
    }

    public function destroy(NursingIndicatorType $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
