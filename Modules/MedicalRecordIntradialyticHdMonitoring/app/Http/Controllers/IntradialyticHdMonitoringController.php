<?php

namespace Modules\MedicalRecordIntradialyticHdMonitoring\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordIntradialyticHdMonitoring\Http\Requests\StoreIntradialyticHdMonitoringRequest;
use Modules\MedicalRecordIntradialyticHdMonitoring\Http\Requests\UpdateIntradialyticHdMonitoringRequest;
use Modules\MedicalRecordIntradialyticHdMonitoring\Http\Resources\IntradialyticHdMonitoringResource;
use Modules\MedicalRecordIntradialyticHdMonitoring\Models\IntradialyticHdMonitoring;

class IntradialyticHdMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $query = IntradialyticHdMonitoring::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return IntradialyticHdMonitoringResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreIntradialyticHdMonitoringRequest $request)
    {
        $data = $request->validated();
        $data['dialysis_hour'] ??= 1;
        $data['monitored_at'] ??= now();

        $record = IntradialyticHdMonitoring::create($data);

        return (new IntradialyticHdMonitoringResource($record))->response()->setStatusCode(201);
    }

    public function show(IntradialyticHdMonitoring $record): IntradialyticHdMonitoringResource
    {
        return new IntradialyticHdMonitoringResource($record);
    }

    public function update(UpdateIntradialyticHdMonitoringRequest $request, IntradialyticHdMonitoring $record): IntradialyticHdMonitoringResource
    {
        $record->update($request->validated());

        return new IntradialyticHdMonitoringResource($record);
    }

    public function destroy(IntradialyticHdMonitoring $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
