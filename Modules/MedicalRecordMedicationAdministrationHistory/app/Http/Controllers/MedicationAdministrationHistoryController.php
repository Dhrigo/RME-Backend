<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordMedicationAdministrationHistory\Http\Requests\StoreMedicationAdministrationHistoryRequest;
use Modules\MedicalRecordMedicationAdministrationHistory\Http\Resources\MedicationAdministrationHistoryResource;
use Modules\MedicalRecordMedicationAdministrationHistory\Models\MedicationAdministrationHistory;

class MedicationAdministrationHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = MedicationAdministrationHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MedicationAdministrationHistoryResource::collection($query->latest('administered_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMedicationAdministrationHistoryRequest $request)
    {
        $data = $request->validated();
        $data['administered_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = MedicationAdministrationHistory::create($data);

        return (new MedicationAdministrationHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(MedicationAdministrationHistory $record): MedicationAdministrationHistoryResource
    {
        return new MedicationAdministrationHistoryResource($record);
    }
}
