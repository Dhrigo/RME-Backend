<?php

namespace Modules\LayananAntimicrobialStewardshipApproval\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipApproval\Http\Requests\StoreAntimicrobialStewardshipApprovalRequest;
use Modules\LayananAntimicrobialStewardshipApproval\Http\Resources\AntimicrobialStewardshipApprovalResource;
use Modules\LayananAntimicrobialStewardshipApproval\Models\AntimicrobialStewardshipApproval;

class AntimicrobialStewardshipApprovalController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipApproval::query();

        return AntimicrobialStewardshipApprovalResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipApprovalRequest $request)
    {
        $data = $request->validated();

        $amr_approval = AntimicrobialStewardshipApproval::create($data);

        return (new AntimicrobialStewardshipApprovalResource($amr_approval))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipApproval $amr_approval): AntimicrobialStewardshipApprovalResource
    {
        return new AntimicrobialStewardshipApprovalResource($amr_approval);
    }
}
