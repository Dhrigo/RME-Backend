<?php

namespace Modules\MedicalRecordBaepSensoryDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepSensoryDetail\Http\Requests\StoreBaepSensoryDetailRequest;
use Modules\MedicalRecordBaepSensoryDetail\Http\Resources\BaepSensoryDetailResource;
use Modules\MedicalRecordBaepSensoryDetail\Models\BaepSensoryDetail;

class BaepSensoryDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepSensoryDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepSensoryDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepSensoryDetailRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = BaepSensoryDetail::create($data);

        return (new BaepSensoryDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepSensoryDetail $record): BaepSensoryDetailResource
    {
        return new BaepSensoryDetailResource($record);
    }
}
