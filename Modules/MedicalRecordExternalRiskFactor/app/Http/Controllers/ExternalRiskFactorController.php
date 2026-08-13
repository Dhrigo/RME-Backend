<?php

namespace Modules\MedicalRecordExternalRiskFactor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordExternalRiskFactor\Http\Requests\StoreExternalRiskFactorRequest;
use Modules\MedicalRecordExternalRiskFactor\Http\Requests\UpdateExternalRiskFactorRequest;
use Modules\MedicalRecordExternalRiskFactor\Http\Resources\ExternalRiskFactorResource;
use Modules\MedicalRecordExternalRiskFactor\Models\ExternalRiskFactor;

class ExternalRiskFactorController extends Controller
{
    public function index(Request $request)
    {
        $query = ExternalRiskFactor::query();

        return ExternalRiskFactorResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreExternalRiskFactorRequest $request)
    {
        $data = $request->validated();

        $record = ExternalRiskFactor::create($data);

        return (new ExternalRiskFactorResource($record))->response()->setStatusCode(201);
    }

    public function show(ExternalRiskFactor $record): ExternalRiskFactorResource
    {
        return new ExternalRiskFactorResource($record);
    }

    public function update(UpdateExternalRiskFactorRequest $request, ExternalRiskFactor $record): ExternalRiskFactorResource
    {
        $record->update($request->validated());

        return new ExternalRiskFactorResource($record);
    }

    public function destroy(ExternalRiskFactor $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
