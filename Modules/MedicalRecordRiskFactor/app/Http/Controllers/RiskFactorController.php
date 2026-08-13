<?php

namespace Modules\MedicalRecordRiskFactor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRiskFactor\Http\Requests\StoreRiskFactorRequest;
use Modules\MedicalRecordRiskFactor\Http\Requests\UpdateRiskFactorRequest;
use Modules\MedicalRecordRiskFactor\Http\Resources\RiskFactorResource;
use Modules\MedicalRecordRiskFactor\Models\RiskFactor;

class RiskFactorController extends Controller
{
    public function index(Request $request)
    {
        $query = RiskFactor::query();

        return RiskFactorResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRiskFactorRequest $request)
    {
        $data = $request->validated();

        $record = RiskFactor::create($data);

        return (new RiskFactorResource($record))->response()->setStatusCode(201);
    }

    public function show(RiskFactor $record): RiskFactorResource
    {
        return new RiskFactorResource($record);
    }

    public function update(UpdateRiskFactorRequest $request, RiskFactor $record): RiskFactorResource
    {
        $record->update($request->validated());

        return new RiskFactorResource($record);
    }

    public function destroy(RiskFactor $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
