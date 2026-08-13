<?php

namespace Modules\MedicalRecordBaepStimulationProtocolDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepStimulationProtocolDetail\Http\Requests\StoreBaepStimulationProtocolDetailRequest;
use Modules\MedicalRecordBaepStimulationProtocolDetail\Http\Resources\BaepStimulationProtocolDetailResource;
use Modules\MedicalRecordBaepStimulationProtocolDetail\Models\BaepStimulationProtocolDetail;

class BaepStimulationProtocolDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepStimulationProtocolDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepStimulationProtocolDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepStimulationProtocolDetailRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = BaepStimulationProtocolDetail::create($data);

        return (new BaepStimulationProtocolDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepStimulationProtocolDetail $record): BaepStimulationProtocolDetailResource
    {
        return new BaepStimulationProtocolDetailResource($record);
    }
}
