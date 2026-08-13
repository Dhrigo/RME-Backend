<?php

namespace Modules\MedicalRecordMaternalPregnancyHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordMaternalPregnancyHistory\Http\Requests\StoreMaternalPregnancyHistoryRequest;
use Modules\MedicalRecordMaternalPregnancyHistory\Http\Resources\MaternalPregnancyHistoryResource;
use Modules\MedicalRecordMaternalPregnancyHistory\Models\MaternalPregnancyHistory;

class MaternalPregnancyHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = MaternalPregnancyHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return MaternalPregnancyHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreMaternalPregnancyHistoryRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = MaternalPregnancyHistory::create($data);

        return (new MaternalPregnancyHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(MaternalPregnancyHistory $record): MaternalPregnancyHistoryResource
    {
        return new MaternalPregnancyHistoryResource($record);
    }
}
