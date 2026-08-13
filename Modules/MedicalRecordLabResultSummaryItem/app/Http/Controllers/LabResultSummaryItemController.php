<?php

namespace Modules\MedicalRecordLabResultSummaryItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordLabResultSummaryItem\Http\Requests\StoreLabResultSummaryItemRequest;
use Modules\MedicalRecordLabResultSummaryItem\Http\Resources\LabResultSummaryItemResource;
use Modules\MedicalRecordLabResultSummaryItem\Models\LabResultSummaryItem;

class LabResultSummaryItemController extends Controller
{
    public function index(Request $request)
    {
        $query = LabResultSummaryItem::query();

        if ($request->filled('summary_id')) {
            $query->where('summary_id', $request->integer('summary_id'));
        }

        return LabResultSummaryItemResource::collection($query->latest('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLabResultSummaryItemRequest $request)
    {
        $data = $request->validated();
        $data['flag'] ??= 'normal';
        $data['created_by'] = $request->user()->id;

        $record = LabResultSummaryItem::create($data);

        return (new LabResultSummaryItemResource($record))->response()->setStatusCode(201);
    }

    public function show(LabResultSummaryItem $record): LabResultSummaryItemResource
    {
        return new LabResultSummaryItemResource($record);
    }
}
