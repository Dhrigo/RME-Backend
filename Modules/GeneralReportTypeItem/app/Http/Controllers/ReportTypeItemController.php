<?php

namespace Modules\GeneralReportTypeItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralReportTypeItem\Http\Requests\StoreReportTypeItemRequest;
use Modules\GeneralReportTypeItem\Http\Requests\UpdateReportTypeItemRequest;
use Modules\GeneralReportTypeItem\Http\Resources\ReportTypeItemResource;
use Modules\GeneralReportTypeItem\Models\ReportTypeItem;

class ReportTypeItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ReportTypeItem::query();

        if ($request->filled('report_type_id')) {
            $query->where('report_type_id', $request->integer('report_type_id'));
        }

        return ReportTypeItemResource::collection($query->orderBy('sequence')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreReportTypeItemRequest $request)
    {
        $item = ReportTypeItem::create($request->validated());

        return (new ReportTypeItemResource($item))->response()->setStatusCode(201);
    }

    public function show(ReportTypeItem $report_type_item): ReportTypeItemResource
    {
        return new ReportTypeItemResource($report_type_item);
    }

    public function update(UpdateReportTypeItemRequest $request, ReportTypeItem $report_type_item): ReportTypeItemResource
    {
        $report_type_item->update($request->validated());

        return new ReportTypeItemResource($report_type_item->fresh());
    }

    public function destroy(ReportTypeItem $report_type_item)
    {
        $report_type_item->delete();

        return response()->json(null, 204);
    }
}
