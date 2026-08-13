<?php

namespace Modules\LayananBirthRecord\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananBirthRecord\Http\Requests\StoreBirthRecordRequest;
use Modules\LayananBirthRecord\Http\Requests\UpdateBirthRecordRequest;
use Modules\LayananBirthRecord\Http\Resources\BirthRecordResource;
use Modules\LayananBirthRecord\Models\BirthRecord;

class BirthRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = BirthRecord::query();

        return BirthRecordResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreBirthRecordRequest $request)
    {
        $data = $request->validated();

        $birth_record = BirthRecord::create($data);

        return (new BirthRecordResource($birth_record))->response()->setStatusCode(201);
    }

    public function show(BirthRecord $birth_record): BirthRecordResource
    {
        return new BirthRecordResource($birth_record);
    }

    public function update(UpdateBirthRecordRequest $request, BirthRecord $birth_record): BirthRecordResource
    {
        $birth_record->update($request->validated());

        return new BirthRecordResource($birth_record);
    }
}
