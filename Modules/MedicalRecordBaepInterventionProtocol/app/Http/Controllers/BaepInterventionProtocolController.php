<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepInterventionProtocol\Http\Requests\StoreBaepInterventionProtocolRequest;
use Modules\MedicalRecordBaepInterventionProtocol\Http\Resources\BaepInterventionProtocolResource;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;

class BaepInterventionProtocolController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepInterventionProtocol::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return BaepInterventionProtocolResource::collection($query->latest('performed_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepInterventionProtocolRequest $request)
    {
        $data = $request->validated();
        $data['status'] ??= 'in_progress';
        $data['performed_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = BaepInterventionProtocol::create($data);

        return (new BaepInterventionProtocolResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepInterventionProtocol $record): BaepInterventionProtocolResource
    {
        return new BaepInterventionProtocolResource($record);
    }
}
