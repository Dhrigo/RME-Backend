<?php

namespace Modules\LayananAntimicrobialStewardshipOtherSupportResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipOtherSupportResult\Http\Requests\StoreAntimicrobialStewardshipOtherSupportResultRequest;
use Modules\LayananAntimicrobialStewardshipOtherSupportResult\Http\Resources\AntimicrobialStewardshipOtherSupportResultResource;
use Modules\LayananAntimicrobialStewardshipOtherSupportResult\Models\AntimicrobialStewardshipOtherSupportResult;

class AntimicrobialStewardshipOtherSupportResultController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipOtherSupportResult::query();

        return AntimicrobialStewardshipOtherSupportResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipOtherSupportResultRequest $request)
    {
        $data = $request->validated();

        $amr_other = AntimicrobialStewardshipOtherSupportResult::create($data);

        return (new AntimicrobialStewardshipOtherSupportResultResource($amr_other))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipOtherSupportResult $amr_other): AntimicrobialStewardshipOtherSupportResultResource
    {
        return new AntimicrobialStewardshipOtherSupportResultResource($amr_other);
    }
}
