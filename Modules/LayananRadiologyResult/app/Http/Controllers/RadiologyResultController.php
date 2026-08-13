<?php

namespace Modules\LayananRadiologyResult\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananRadiologyResult\Http\Requests\StoreRadiologyResultRequest;
use Modules\LayananRadiologyResult\Http\Requests\UpdateRadiologyResultRequest;
use Modules\LayananRadiologyResult\Http\Resources\RadiologyResultResource;
use Modules\LayananRadiologyResult\Models\RadiologyResult;

class RadiologyResultController extends Controller
{
    public function index(Request $request)
    {
        $query = RadiologyResult::query();

        return RadiologyResultResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreRadiologyResultRequest $request)
    {
        $data = $request->validated();
        $data['status'] = $data['status'] ?? 'pending';
        $rad_result = RadiologyResult::create($data);

        return (new RadiologyResultResource($rad_result))->response()->setStatusCode(201);
    }

    public function show(RadiologyResult $rad_result): RadiologyResultResource
    {
        return new RadiologyResultResource($rad_result);
    }

    public function update(UpdateRadiologyResultRequest $request, RadiologyResult $rad_result): RadiologyResultResource
    {
        $rad_result->update($request->validated());

        return new RadiologyResultResource($rad_result);
    }
}
