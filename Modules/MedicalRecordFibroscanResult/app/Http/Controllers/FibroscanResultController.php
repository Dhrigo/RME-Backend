<?php

namespace Modules\MedicalRecordFibroscanResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordFibroscanResult\Http\Requests\StoreFibroscanResultRequest;
use Modules\MedicalRecordFibroscanResult\Http\Requests\UpdateFibroscanResultRequest;
use Modules\MedicalRecordFibroscanResult\Http\Resources\FibroscanResultResource;
use Modules\MedicalRecordFibroscanResult\Models\FibroscanResult;

class FibroscanResultController extends Controller
{
    public function index(Request $request)
    {
        $query = FibroscanResult::query();

        return FibroscanResultResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFibroscanResultRequest $request)
    {
        $data = $request->validated();

        $record = FibroscanResult::create($data);

        return (new FibroscanResultResource($record))->response()->setStatusCode(201);
    }

    public function show(FibroscanResult $record): FibroscanResultResource
    {
        return new FibroscanResultResource($record);
    }

    public function update(UpdateFibroscanResultRequest $request, FibroscanResult $record): FibroscanResultResource
    {
        $record->update($request->validated());

        return new FibroscanResultResource($record);
    }

    public function destroy(FibroscanResult $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
