<?php

namespace Modules\MedicalRecordBaepCognitiveDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepCognitiveDetail\Http\Requests\StoreBaepCognitiveDetailRequest;
use Modules\MedicalRecordBaepCognitiveDetail\Http\Resources\BaepCognitiveDetailResource;
use Modules\MedicalRecordBaepCognitiveDetail\Models\BaepCognitiveDetail;

class BaepCognitiveDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepCognitiveDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepCognitiveDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepCognitiveDetailRequest $request)
    {
        $data = $request->validated();
        $data['scale_used'] ??= 'MOCA';
        $data['created_by'] = $request->user()->id;

        $record = BaepCognitiveDetail::create($data);

        return (new BaepCognitiveDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepCognitiveDetail $record): BaepCognitiveDetailResource
    {
        return new BaepCognitiveDetailResource($record);
    }
}
