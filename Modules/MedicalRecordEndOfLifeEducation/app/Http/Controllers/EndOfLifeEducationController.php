<?php

namespace Modules\MedicalRecordEndOfLifeEducation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordEndOfLifeEducation\Http\Requests\StoreEndOfLifeEducationRequest;
use Modules\MedicalRecordEndOfLifeEducation\Http\Requests\UpdateEndOfLifeEducationRequest;
use Modules\MedicalRecordEndOfLifeEducation\Http\Resources\EndOfLifeEducationResource;
use Modules\MedicalRecordEndOfLifeEducation\Models\EndOfLifeEducation;

class EndOfLifeEducationController extends Controller
{
    public function index(Request $request)
    {
        $query = EndOfLifeEducation::query();

        return EndOfLifeEducationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEndOfLifeEducationRequest $request)
    {
        $data = $request->validated();

        $record = EndOfLifeEducation::create($data);

        return (new EndOfLifeEducationResource($record))->response()->setStatusCode(201);
    }

    public function show(EndOfLifeEducation $record): EndOfLifeEducationResource
    {
        return new EndOfLifeEducationResource($record);
    }

    public function update(UpdateEndOfLifeEducationRequest $request, EndOfLifeEducation $record): EndOfLifeEducationResource
    {
        $record->update($request->validated());

        return new EndOfLifeEducationResource($record);
    }

    public function destroy(EndOfLifeEducation $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
