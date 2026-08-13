<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingIndicatorImplementation\Http\Requests\StoreNursingIndicatorImplementationRequest;
use Modules\MedicalRecordNursingIndicatorImplementation\Http\Resources\NursingIndicatorImplementationResource;
use Modules\MedicalRecordNursingIndicatorImplementation\Models\NursingIndicatorImplementation;

class NursingIndicatorImplementationController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingIndicatorImplementation::query();

        return NursingIndicatorImplementationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingIndicatorImplementationRequest $request)
    {
        $data = $request->validated();

        $record = NursingIndicatorImplementation::create($data);

        return (new NursingIndicatorImplementationResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingIndicatorImplementation $record): NursingIndicatorImplementationResource
    {
        return new NursingIndicatorImplementationResource($record);
    }

    public function destroy(NursingIndicatorImplementation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
