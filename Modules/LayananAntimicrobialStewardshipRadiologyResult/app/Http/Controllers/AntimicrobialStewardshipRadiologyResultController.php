<?php

namespace Modules\LayananAntimicrobialStewardshipRadiologyResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipRadiologyResult\Http\Requests\StoreAntimicrobialStewardshipRadiologyResultRequest;
use Modules\LayananAntimicrobialStewardshipRadiologyResult\Http\Resources\AntimicrobialStewardshipRadiologyResultResource;
use Modules\LayananAntimicrobialStewardshipRadiologyResult\Models\AntimicrobialStewardshipRadiologyResult;

class AntimicrobialStewardshipRadiologyResultController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipRadiologyResult::query();

        return AntimicrobialStewardshipRadiologyResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipRadiologyResultRequest $request)
    {
        $data = $request->validated();

        $amr_rad = AntimicrobialStewardshipRadiologyResult::create($data);

        return (new AntimicrobialStewardshipRadiologyResultResource($amr_rad))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipRadiologyResult $amr_rad): AntimicrobialStewardshipRadiologyResultResource
    {
        return new AntimicrobialStewardshipRadiologyResultResource($amr_rad);
    }
}
