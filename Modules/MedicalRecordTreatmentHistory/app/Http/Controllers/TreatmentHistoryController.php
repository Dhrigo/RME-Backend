<?php

namespace Modules\MedicalRecordTreatmentHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTreatmentHistory\Http\Requests\StoreTreatmentHistoryRequest;
use Modules\MedicalRecordTreatmentHistory\Http\Resources\TreatmentHistoryResource;
use Modules\MedicalRecordTreatmentHistory\Models\TreatmentHistory;

class TreatmentHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = TreatmentHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TreatmentHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTreatmentHistoryRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = TreatmentHistory::create($data);

        return (new TreatmentHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(TreatmentHistory $record): TreatmentHistoryResource
    {
        return new TreatmentHistoryResource($record);
    }
}
