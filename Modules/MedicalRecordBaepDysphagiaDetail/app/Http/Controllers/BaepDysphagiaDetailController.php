<?php

namespace Modules\MedicalRecordBaepDysphagiaDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepDysphagiaDetail\Http\Requests\StoreBaepDysphagiaDetailRequest;
use Modules\MedicalRecordBaepDysphagiaDetail\Http\Resources\BaepDysphagiaDetailResource;
use Modules\MedicalRecordBaepDysphagiaDetail\Models\BaepDysphagiaDetail;

class BaepDysphagiaDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepDysphagiaDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepDysphagiaDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepDysphagiaDetailRequest $request)
    {
        $data = $request->validated();
        $data['swallowing_test_used'] ??= 'GUSS';
        $data['aspiration_risk'] ??= false;
        $data['created_by'] = $request->user()->id;

        $record = BaepDysphagiaDetail::create($data);

        return (new BaepDysphagiaDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepDysphagiaDetail $record): BaepDysphagiaDetailResource
    {
        return new BaepDysphagiaDetailResource($record);
    }
}
