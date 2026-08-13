<?php

namespace Modules\MedicalRecordNursingImplementation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordNursingImplementation\Http\Requests\StoreNursingImplementationRequest;
use Modules\MedicalRecordNursingImplementation\Http\Requests\UpdateNursingImplementationRequest;
use Modules\MedicalRecordNursingImplementation\Http\Resources\NursingImplementationResource;
use Modules\MedicalRecordNursingImplementation\Models\NursingImplementation;

class NursingImplementationController extends Controller
{
    public function index(Request $request)
    {
        $query = NursingImplementation::query();

        return NursingImplementationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreNursingImplementationRequest $request)
    {
        $data = $request->validated();

        $record = NursingImplementation::create($data);

        return (new NursingImplementationResource($record))->response()->setStatusCode(201);
    }

    public function show(NursingImplementation $record): NursingImplementationResource
    {
        return new NursingImplementationResource($record);
    }

    public function update(UpdateNursingImplementationRequest $request, NursingImplementation $record): NursingImplementationResource
    {
        $record->update($request->validated());

        return new NursingImplementationResource($record);
    }

    public function destroy(NursingImplementation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
