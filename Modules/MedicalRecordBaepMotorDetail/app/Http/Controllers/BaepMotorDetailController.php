<?php

namespace Modules\MedicalRecordBaepMotorDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepMotorDetail\Http\Requests\StoreBaepMotorDetailRequest;
use Modules\MedicalRecordBaepMotorDetail\Http\Resources\BaepMotorDetailResource;
use Modules\MedicalRecordBaepMotorDetail\Models\BaepMotorDetail;

class BaepMotorDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepMotorDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepMotorDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepMotorDetailRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = BaepMotorDetail::create($data);

        return (new BaepMotorDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepMotorDetail $record): BaepMotorDetailResource
    {
        return new BaepMotorDetailResource($record);
    }
}
