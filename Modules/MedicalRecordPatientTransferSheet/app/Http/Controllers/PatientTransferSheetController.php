<?php

namespace Modules\MedicalRecordPatientTransferSheet\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordPatientTransferSheet\Http\Requests\StorePatientTransferSheetRequest;
use Modules\MedicalRecordPatientTransferSheet\Http\Requests\UpdatePatientTransferSheetRequest;
use Modules\MedicalRecordPatientTransferSheet\Http\Resources\PatientTransferSheetResource;
use Modules\MedicalRecordPatientTransferSheet\Models\PatientTransferSheet;

class PatientTransferSheetController extends Controller
{
    public function index(Request $request)
    {
        $query = PatientTransferSheet::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return PatientTransferSheetResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StorePatientTransferSheetRequest $request)
    {
        $data = $request->validated();
        $data['transferred_at'] ??= now();

        $record = PatientTransferSheet::create($data);

        return (new PatientTransferSheetResource($record))->response()->setStatusCode(201);
    }

    public function show(PatientTransferSheet $record): PatientTransferSheetResource
    {
        return new PatientTransferSheetResource($record);
    }

    public function update(UpdatePatientTransferSheetRequest $request, PatientTransferSheet $record): PatientTransferSheetResource
    {
        $record->update($request->validated());

        return new PatientTransferSheetResource($record);
    }

    public function destroy(PatientTransferSheet $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
