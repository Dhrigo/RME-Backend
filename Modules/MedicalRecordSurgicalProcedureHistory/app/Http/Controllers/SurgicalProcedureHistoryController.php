<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordSurgicalProcedureHistory\Http\Requests\StoreSurgicalProcedureHistoryRequest;
use Modules\MedicalRecordSurgicalProcedureHistory\Http\Resources\SurgicalProcedureHistoryResource;
use Modules\MedicalRecordSurgicalProcedureHistory\Models\SurgicalProcedureHistory;

class SurgicalProcedureHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = SurgicalProcedureHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return SurgicalProcedureHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreSurgicalProcedureHistoryRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = SurgicalProcedureHistory::create($data);

        return (new SurgicalProcedureHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(SurgicalProcedureHistory $record): SurgicalProcedureHistoryResource
    {
        return new SurgicalProcedureHistoryResource($record);
    }
}
