<?php

namespace Modules\MedicalRecordRadiologyResultSummaryItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRadiologyResultSummaryItem\Http\Requests\StoreRadiologyResultSummaryItemRequest;
use Modules\MedicalRecordRadiologyResultSummaryItem\Http\Resources\RadiologyResultSummaryItemResource;
use Modules\MedicalRecordRadiologyResultSummaryItem\Models\RadiologyResultSummaryItem;

class RadiologyResultSummaryItemController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyResultSummaryItem::query();

        if ($request->filled('summary_id')) {
            $query->where('summary_id', $request->integer('summary_id'));
        }

        return RadiologyResultSummaryItemResource::collection($query->latest('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyResultSummaryItemRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;

        $record = RadiologyResultSummaryItem::create($data);

        return (new RadiologyResultSummaryItemResource($record))->response()->setStatusCode(201);
    }

    public function show(RadiologyResultSummaryItem $record): RadiologyResultSummaryItemResource
    {
        return new RadiologyResultSummaryItemResource($record);
    }
}
