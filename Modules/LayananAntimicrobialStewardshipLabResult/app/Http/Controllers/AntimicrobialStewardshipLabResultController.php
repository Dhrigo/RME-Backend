<?php

namespace Modules\LayananAntimicrobialStewardshipLabResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipLabResult\Http\Requests\StoreAntimicrobialStewardshipLabResultRequest;
use Modules\LayananAntimicrobialStewardshipLabResult\Http\Resources\AntimicrobialStewardshipLabResultResource;
use Modules\LayananAntimicrobialStewardshipLabResult\Models\AntimicrobialStewardshipLabResult;

class AntimicrobialStewardshipLabResultController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipLabResult::query();

        return AntimicrobialStewardshipLabResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipLabResultRequest $request)
    {
        $data = $request->validated();

        $amr_lab = AntimicrobialStewardshipLabResult::create($data);

        return (new AntimicrobialStewardshipLabResultResource($amr_lab))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipLabResult $amr_lab): AntimicrobialStewardshipLabResultResource
    {
        return new AntimicrobialStewardshipLabResultResource($amr_lab);
    }
}
