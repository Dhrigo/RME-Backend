<?php

namespace Modules\PendaftaranAccidentRecord\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PendaftaranAccidentRecord\Http\Requests\StoreAccidentRecordRequest;
use Modules\PendaftaranAccidentRecord\Http\Resources\AccidentRecordResource;
use Modules\PendaftaranAccidentRecord\Models\AccidentRecord;

class AccidentRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = AccidentRecord::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AccidentRecordResource::collection($query->latest('accident_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAccidentRecordRequest $request)
    {
        $data = $request->validated();
        $accident = AccidentRecord::create($data);

        return (new AccidentRecordResource($accident))->response()->setStatusCode(201);
    }

    public function show(AccidentRecord $accidentrecord): AccidentRecordResource
    {
        return new AccidentRecordResource($accidentrecord);
    }
}
