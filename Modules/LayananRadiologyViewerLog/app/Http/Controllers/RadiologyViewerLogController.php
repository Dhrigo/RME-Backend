<?php

namespace Modules\LayananRadiologyViewerLog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananRadiologyViewerLog\Http\Requests\StoreRadiologyViewerLogRequest;
use Modules\LayananRadiologyViewerLog\Http\Resources\RadiologyViewerLogResource;
use Modules\LayananRadiologyViewerLog\Models\RadiologyViewerLog;

class RadiologyViewerLogController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyViewerLog::query();

        return RadiologyViewerLogResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyViewerLogRequest $request)
    {
        $data = $request->validated();

        $record = RadiologyViewerLog::create($data);

        return (new RadiologyViewerLogResource($record))->response()->setStatusCode(201);
    }

    public function show(RadiologyViewerLog $record): RadiologyViewerLogResource
    {
        return new RadiologyViewerLogResource($record);
    }

    public function destroy(RadiologyViewerLog $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
