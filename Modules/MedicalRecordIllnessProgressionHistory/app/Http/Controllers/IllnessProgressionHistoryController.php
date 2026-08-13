<?php

namespace Modules\MedicalRecordIllnessProgressionHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordIllnessProgressionHistory\Http\Requests\StoreIllnessProgressionHistoryRequest;
use Modules\MedicalRecordIllnessProgressionHistory\Http\Resources\IllnessProgressionHistoryResource;
use Modules\MedicalRecordIllnessProgressionHistory\Models\IllnessProgressionHistory;

class IllnessProgressionHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = IllnessProgressionHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return IllnessProgressionHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreIllnessProgressionHistoryRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = IllnessProgressionHistory::create($data);

        return (new IllnessProgressionHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(IllnessProgressionHistory $record): IllnessProgressionHistoryResource
    {
        return new IllnessProgressionHistoryResource($record);
    }
}
