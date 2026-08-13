<?php

namespace Modules\LayananAntimicrobialStewardshipFormItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananAntimicrobialStewardshipFormItem\Http\Requests\StoreAntimicrobialStewardshipFormItemRequest;
use Modules\LayananAntimicrobialStewardshipFormItem\Http\Resources\AntimicrobialStewardshipFormItemResource;
use Modules\LayananAntimicrobialStewardshipFormItem\Models\AntimicrobialStewardshipFormItem;

class AntimicrobialStewardshipFormItemController extends Controller
{
    public function index(Request $request)
    {
        $query = AntimicrobialStewardshipFormItem::query();

        return AntimicrobialStewardshipFormItemResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAntimicrobialStewardshipFormItemRequest $request)
    {
        $data = $request->validated();

        $amr_item = AntimicrobialStewardshipFormItem::create($data);

        return (new AntimicrobialStewardshipFormItemResource($amr_item))->response()->setStatusCode(201);
    }

    public function show(AntimicrobialStewardshipFormItem $amr_item): AntimicrobialStewardshipFormItemResource
    {
        return new AntimicrobialStewardshipFormItemResource($amr_item);
    }
}
