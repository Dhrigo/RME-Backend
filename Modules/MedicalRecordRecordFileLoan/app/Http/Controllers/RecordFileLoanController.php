<?php

namespace Modules\MedicalRecordRecordFileLoan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRecordFileLoan\Http\Requests\StoreRecordFileLoanRequest;
use Modules\MedicalRecordRecordFileLoan\Http\Requests\UpdateRecordFileLoanRequest;
use Modules\MedicalRecordRecordFileLoan\Http\Resources\RecordFileLoanResource;
use Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan;

class RecordFileLoanController extends Controller
{
    public function index(Request $request)
    {
        $query = RecordFileLoan::query();


        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return RecordFileLoanResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreRecordFileLoanRequest $request)
    {
        $data = $request->validated();

        $record = RecordFileLoan::create($data);

        return (new RecordFileLoanResource($record))->response()->setStatusCode(201);
    }

    public function show(RecordFileLoan $record): RecordFileLoanResource
    {
        return new RecordFileLoanResource($record);
    }

    public function update(UpdateRecordFileLoanRequest $request, RecordFileLoan $record): RecordFileLoanResource
    {
        $record->update($request->validated());

        return new RecordFileLoanResource($record);
    }

    public function destroy(RecordFileLoan $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
