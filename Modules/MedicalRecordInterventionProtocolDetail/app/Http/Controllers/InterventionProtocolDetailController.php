<?php

namespace Modules\MedicalRecordInterventionProtocolDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordInterventionProtocolDetail\Http\Requests\StoreInterventionProtocolDetailRequest;
use Modules\MedicalRecordInterventionProtocolDetail\Http\Resources\InterventionProtocolDetailResource;
use Modules\MedicalRecordInterventionProtocolDetail\Models\InterventionProtocolDetail;

class InterventionProtocolDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = InterventionProtocolDetail::query();

        if ($request->filled('protocol_id')) {
            $query->where('protocol_id', $request->integer('protocol_id'));
        }

        return InterventionProtocolDetailResource::collection($query->latest('step_number')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInterventionProtocolDetailRequest $request)
    {
        $data = $request->validated();
        $data['performed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = InterventionProtocolDetail::create($data);

        return (new InterventionProtocolDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(InterventionProtocolDetail $record): InterventionProtocolDetailResource
    {
        return new InterventionProtocolDetailResource($record);
    }
}
