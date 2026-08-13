<?php

namespace Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Http\Requests\StoreAntimicrobialStewardshipMicrobiologyResultRequest;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Http\Resources\AntimicrobialStewardshipMicrobiologyResultResource;
use Modules\LayananAntimicrobialStewardshipMicrobiologyResult\Models\AntimicrobialStewardshipMicrobiologyResult;

class AntimicrobialStewardshipMicrobiologyResultController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipMicrobiologyResult::query();

        return AntimicrobialStewardshipMicrobiologyResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipMicrobiologyResultRequest $request)
    {
        $data = $request->validated();

        $amr_micro = AntimicrobialStewardshipMicrobiologyResult::create($data);

        return (new AntimicrobialStewardshipMicrobiologyResultResource($amr_micro))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipMicrobiologyResult $amr_micro): AntimicrobialStewardshipMicrobiologyResultResource
    {
        return new AntimicrobialStewardshipMicrobiologyResultResource($amr_micro);
    }
}
