<?php

namespace Modules\MedicalRecordDischargeSummary\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordDischargeSummary\Http\Requests\StoreDischargeSummaryRequest;
use Modules\MedicalRecordDischargeSummary\Http\Resources\DischargeSummaryResource;
use Modules\MedicalRecordDischargeSummary\Models\DischargeSummary;

class DischargeSummaryController extends Controller
{
    public function index(Request $request)
    {
        $query = DischargeSummary::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return DischargeSummaryResource::collection($query->latest('authored_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * Discharge summaries are a legal medical record - append-only, no update/delete.
     * Corrections belong in a new summary, not an edit of history.
     */
    public function store(StoreDischargeSummaryRequest $request)
    {
        $data = $request->validated();
        $data['authored_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $summary = DischargeSummary::create($data);

        return (new DischargeSummaryResource($summary))->response()->setStatusCode(201);
    }

    public function show(DischargeSummary $discharge_summary): DischargeSummaryResource
    {
        return new DischargeSummaryResource($discharge_summary);
    }
}
