<?php

namespace Modules\MedicalRecordImmunizationVaccination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImmunizationVaccination\Http\Requests\StoreImmunizationVaccinationRequest;
use Modules\MedicalRecordImmunizationVaccination\Http\Requests\UpdateImmunizationVaccinationRequest;
use Modules\MedicalRecordImmunizationVaccination\Http\Resources\ImmunizationVaccinationResource;
use Modules\MedicalRecordImmunizationVaccination\Models\ImmunizationVaccination;

class ImmunizationVaccinationController extends Controller
{
    public function index(Request $request)
    {
        $query = ImmunizationVaccination::query();

        return ImmunizationVaccinationResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreImmunizationVaccinationRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'completed';

        $record = ImmunizationVaccination::create($data);

        return (new ImmunizationVaccinationResource($record))->response()->setStatusCode(201);
    }

    public function show(ImmunizationVaccination $record): ImmunizationVaccinationResource
    {
        return new ImmunizationVaccinationResource($record);
    }

    public function update(UpdateImmunizationVaccinationRequest $request, ImmunizationVaccination $record): ImmunizationVaccinationResource
    {
        $record->update($request->validated());

        return new ImmunizationVaccinationResource($record);
    }

    public function destroy(ImmunizationVaccination $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
