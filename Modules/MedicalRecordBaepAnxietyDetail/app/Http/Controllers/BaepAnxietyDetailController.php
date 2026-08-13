<?php

namespace Modules\MedicalRecordBaepAnxietyDetail\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordBaepAnxietyDetail\Http\Requests\StoreBaepAnxietyDetailRequest;
use Modules\MedicalRecordBaepAnxietyDetail\Http\Resources\BaepAnxietyDetailResource;
use Modules\MedicalRecordBaepAnxietyDetail\Models\BaepAnxietyDetail;

class BaepAnxietyDetailController extends Controller
{
    public function index(Request $request)
    {
        $query = BaepAnxietyDetail::query();

        if ($request->filled('baep_protocol_id')) {
            $query->where('baep_protocol_id', $request->integer('baep_protocol_id'));
        }

        return BaepAnxietyDetailResource::collection($query->latest('created_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBaepAnxietyDetailRequest $request)
    {
        $data = $request->validated();
        $data['scale_used'] ??= 'HAM-A';
        $data['created_by'] = $request->user()->id;

        $record = BaepAnxietyDetail::create($data);

        return (new BaepAnxietyDetailResource($record))->response()->setStatusCode(201);
    }

    public function show(BaepAnxietyDetail $record): BaepAnxietyDetailResource
    {
        return new BaepAnxietyDetailResource($record);
    }
}
