<?php

namespace Modules\LayananAntimicrobialStewardshipForm\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipForm\Http\Requests\StoreAntimicrobialStewardshipFormRequest;
use Modules\LayananAntimicrobialStewardshipForm\Http\Requests\UpdateAntimicrobialStewardshipFormRequest;
use Modules\LayananAntimicrobialStewardshipForm\Http\Resources\AntimicrobialStewardshipFormResource;
use Modules\LayananAntimicrobialStewardshipForm\Models\AntimicrobialStewardshipForm;

class AntimicrobialStewardshipFormController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipForm::query();

        return AntimicrobialStewardshipFormResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipFormRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'draft';
        $amr_form = AntimicrobialStewardshipForm::create($data);

        return (new AntimicrobialStewardshipFormResource($amr_form))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipForm $amr_form): AntimicrobialStewardshipFormResource
    {
        return new AntimicrobialStewardshipFormResource($amr_form);
    }

    public function update(UpdateAntimicrobialStewardshipFormRequest $request, AntimicrobialStewardshipForm $amr_form): AntimicrobialStewardshipFormResource
    {
        $amr_form->update($request->validated());

        return new AntimicrobialStewardshipFormResource($amr_form);
    }
}
