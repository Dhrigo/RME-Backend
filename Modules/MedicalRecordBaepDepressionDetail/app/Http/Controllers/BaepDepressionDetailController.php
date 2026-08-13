<?php

namespace Modules\MedicalRecordBaepDepressionDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepDepressionDetail\Http\Requests\StoreBaepDepressionDetailRequest;
use Modules\MedicalRecordBaepDepressionDetail\Http\Resources\BaepDepressionDetailResource;
use Modules\MedicalRecordBaepDepressionDetail\Models\BaepDepressionDetail;

class BaepDepressionDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepDepressionDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepDepressionDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepDepressionDetailRequest $request)
    {
        $data = $request->validated();
        $data['scale_used'] ??= 'HDRS';
        $data['created_by'] = $request->user()->id;

        $record = BaepDepressionDetail::create($data);

        return (new BaepDepressionDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepDepressionDetail $record): BaepDepressionDetailResource
    {
        return new BaepDepressionDetailResource($record);
    }
}
