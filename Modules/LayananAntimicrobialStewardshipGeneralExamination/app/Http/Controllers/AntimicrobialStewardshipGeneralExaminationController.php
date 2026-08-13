<?php

namespace Modules\LayananAntimicrobialStewardshipGeneralExamination\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Http\Requests\StoreAntimicrobialStewardshipGeneralExaminationRequest;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Http\Resources\AntimicrobialStewardshipGeneralExaminationResource;
use Modules\LayananAntimicrobialStewardshipGeneralExamination\Models\AntimicrobialStewardshipGeneralExamination;

class AntimicrobialStewardshipGeneralExaminationController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipGeneralExamination::query();

        return AntimicrobialStewardshipGeneralExaminationResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipGeneralExaminationRequest $request)
    {
        $data = $request->validated();

        $amr_exam = AntimicrobialStewardshipGeneralExamination::create($data);

        return (new AntimicrobialStewardshipGeneralExaminationResource($amr_exam))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipGeneralExamination $amr_exam): AntimicrobialStewardshipGeneralExaminationResource
    {
        return new AntimicrobialStewardshipGeneralExaminationResource($amr_exam);
    }
}
