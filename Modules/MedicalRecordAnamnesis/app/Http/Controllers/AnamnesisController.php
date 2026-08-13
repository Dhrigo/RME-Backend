<?php

namespace Modules\MedicalRecordAnamnesis\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAnamnesis\Http\Requests\StoreAnamnesisRequest;
use Modules\MedicalRecordAnamnesis\Http\Requests\UpdateAnamnesisRequest;
use Modules\MedicalRecordAnamnesis\Http\Resources\AnamnesisResource;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;

class AnamnesisController extends Controller
{
    public function index(Request $request)
    {
        $query = Anamnesis::query();

        return AnamnesisResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAnamnesisRequest $request)
    {
        $data = $request->validated();

        $record = Anamnesis::create($data);

        return (new AnamnesisResource($record))->response()->setStatusCode(201);
    }

    public function show(Anamnesis $record): AnamnesisResource
    {
        return new AnamnesisResource($record);
    }

    public function update(UpdateAnamnesisRequest $request, Anamnesis $record): AnamnesisResource
    {
        $record->update($request->validated());

        return new AnamnesisResource($record);
    }

    public function destroy(Anamnesis $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
