<?php

namespace Modules\GeneralReportType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralReportType\Models\ReportType;

class ReportTypeController extends Controller
{
    public function index()
    {
        return ReportType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'class_name' => ['required', 'string', 'max:255'],
            'module' => ['required', 'string', 'max:10'],
            'level' => ['sometimes', 'integer', 'min:1', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ReportType::create($data)->refresh(), 201);
    }

    public function show(ReportType $reportType): ReportType
    {
        return $reportType;
    }

    public function update(Request $request, ReportType $reportType): ReportType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'class_name' => ['sometimes', 'string', 'max:255'],
            'module' => ['sometimes', 'string', 'max:10'],
            'level' => ['sometimes', 'integer', 'min:1', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $reportType->update($data);

        return $reportType;
    }

    public function destroy(ReportType $reportType)
    {
        $reportType->delete();

        return response()->json(null, 204);
    }
}
