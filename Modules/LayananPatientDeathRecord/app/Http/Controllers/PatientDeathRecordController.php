<?php

namespace Modules\LayananPatientDeathRecord\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananPatientDeathRecord\Http\Requests\StorePatientDeathRecordRequest;
use Modules\LayananPatientDeathRecord\Http\Requests\UpdatePatientDeathRecordRequest;
use Modules\LayananPatientDeathRecord\Http\Resources\PatientDeathRecordResource;
use Modules\LayananPatientDeathRecord\Models\PatientDeathRecord;

class PatientDeathRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientDeathRecord::query();

        return PatientDeathRecordResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePatientDeathRecordRequest $request)
    {
        $data = $request->validated();

        $death_record = PatientDeathRecord::create($data);

        return (new PatientDeathRecordResource($death_record))->response()->setStatusCode(201);
    }

    public function show(PatientDeathRecord $death_record): PatientDeathRecordResource
    {
        return new PatientDeathRecordResource($death_record);
    }

    public function update(UpdatePatientDeathRecordRequest $request, PatientDeathRecord $death_record): PatientDeathRecordResource
    {
        $death_record->update($request->validated());

        return new PatientDeathRecordResource($death_record);
    }
}
