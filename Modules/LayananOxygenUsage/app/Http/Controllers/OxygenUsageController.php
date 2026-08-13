<?php

namespace Modules\LayananOxygenUsage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananOxygenUsage\Http\Requests\StoreOxygenUsageRequest;
use Modules\LayananOxygenUsage\Http\Requests\UpdateOxygenUsageRequest;
use Modules\LayananOxygenUsage\Http\Resources\OxygenUsageResource;
use Modules\LayananOxygenUsage\Models\OxygenUsage;

class OxygenUsageController extends Controller
{
    public function index(Request $request)
    {
        $query = OxygenUsage::query();

        return OxygenUsageResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreOxygenUsageRequest $request)
    {
        $data = $request->validated();

        $oxygen_usage = OxygenUsage::create($data);

        return (new OxygenUsageResource($oxygen_usage))->response()->setStatusCode(201);
    }

    public function show(OxygenUsage $oxygen_usage): OxygenUsageResource
    {
        return new OxygenUsageResource($oxygen_usage);
    }

    public function update(UpdateOxygenUsageRequest $request, OxygenUsage $oxygen_usage): OxygenUsageResource
    {
        $oxygen_usage->update($request->validated());

        return new OxygenUsageResource($oxygen_usage);
    }
}
