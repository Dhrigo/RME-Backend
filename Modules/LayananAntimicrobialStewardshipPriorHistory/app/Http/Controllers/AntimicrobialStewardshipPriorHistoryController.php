<?php

namespace Modules\LayananAntimicrobialStewardshipPriorHistory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipPriorHistory\Http\Requests\StoreAntimicrobialStewardshipPriorHistoryRequest;
use Modules\LayananAntimicrobialStewardshipPriorHistory\Http\Resources\AntimicrobialStewardshipPriorHistoryResource;
use Modules\LayananAntimicrobialStewardshipPriorHistory\Models\AntimicrobialStewardshipPriorHistory;

class AntimicrobialStewardshipPriorHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipPriorHistory::query();

        return AntimicrobialStewardshipPriorHistoryResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipPriorHistoryRequest $request)
    {
        $data = $request->validated();

        $amr_history = AntimicrobialStewardshipPriorHistory::create($data);

        return (new AntimicrobialStewardshipPriorHistoryResource($amr_history))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipPriorHistory $amr_history): AntimicrobialStewardshipPriorHistoryResource
    {
        return new AntimicrobialStewardshipPriorHistoryResource($amr_history);
    }
}
