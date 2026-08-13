<?php

namespace Modules\MedicalRecordBaepInsomniaDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepInsomniaDetail\Http\Requests\StoreBaepInsomniaDetailRequest;
use Modules\MedicalRecordBaepInsomniaDetail\Http\Resources\BaepInsomniaDetailResource;
use Modules\MedicalRecordBaepInsomniaDetail\Models\BaepInsomniaDetail;

class BaepInsomniaDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepInsomniaDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepInsomniaDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepInsomniaDetailRequest $request)
    {
        $data = $request->validated();
        $data['scale_used'] ??= 'ISI';
        $data['created_by'] = $request->user()->id;

        $record = BaepInsomniaDetail::create($data);

        return (new BaepInsomniaDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepInsomniaDetail $record): BaepInsomniaDetailResource
    {
        return new BaepInsomniaDetailResource($record);
    }
}
