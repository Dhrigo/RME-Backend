<?php

namespace Modules\MedicalRecordAnamnesisSource\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordAnamnesisSource\Http\Requests\StoreAnamnesisSourceRequest;
use Modules\MedicalRecordAnamnesisSource\Http\Requests\UpdateAnamnesisSourceRequest;
use Modules\MedicalRecordAnamnesisSource\Http\Resources\AnamnesisSourceResource;
use Modules\MedicalRecordAnamnesisSource\Models\AnamnesisSource;

class AnamnesisSourceController extends Controller
{
    public function index(Request $request)
    {
        $query = AnamnesisSource::query();

        return AnamnesisSourceResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAnamnesisSourceRequest $request)
    {
        $data = $request->validated();

        $record = AnamnesisSource::create($data);

        return (new AnamnesisSourceResource($record))->response()->setStatusCode(201);
    }

    public function show(AnamnesisSource $record): AnamnesisSourceResource
    {
        return new AnamnesisSourceResource($record);
    }

    public function update(UpdateAnamnesisSourceRequest $request, AnamnesisSource $record): AnamnesisSourceResource
    {
        $record->update($request->validated());

        return new AnamnesisSourceResource($record);
    }

    public function destroy(AnamnesisSource $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
