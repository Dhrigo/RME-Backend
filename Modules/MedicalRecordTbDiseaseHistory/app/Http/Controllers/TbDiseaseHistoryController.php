<?php

namespace Modules\MedicalRecordTbDiseaseHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordTbDiseaseHistory\Http\Requests\StoreTbDiseaseHistoryRequest;
use Modules\MedicalRecordTbDiseaseHistory\Http\Resources\TbDiseaseHistoryResource;
use Modules\MedicalRecordTbDiseaseHistory\Models\TbDiseaseHistory;

class TbDiseaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = TbDiseaseHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return TbDiseaseHistoryResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreTbDiseaseHistoryRequest $request)
    {
        $data = $request->validated();
        $data['previous_tb_treatment'] ??= false;
        $data['created_by'] = $request->user()->id;

        $record = TbDiseaseHistory::create($data);

        return (new TbDiseaseHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(TbDiseaseHistory $record): TbDiseaseHistoryResource
    {
        return new TbDiseaseHistoryResource($record);
    }
}
